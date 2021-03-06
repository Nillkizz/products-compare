<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Helpers\Images;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Store extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia, Searchable;

  const SEARCH_COLUMN = 'name';
  const STATUS = [
    'updated' => [
      'value' => 'updated',
      'verbose' => 'Updated',
      'icon' => 'fa fa-check',
      'color' => 'success',
    ],
    'updating' => [
      'value' => 'updating',
      'verbose' => 'Updating',
      'icon' => 'fa fa-rotate',
      'color' => 'warning',
    ]
  ];
  const contactTypes = [
    'phone' => ['value' => 'phone', 'verbose' => 'Phone'],
    'email' => ['value' => 'email', 'verbose' => 'Email'],
    'address' => ['value' => 'address', 'verbose' => 'Address']
  ];

  protected $fillable = ['name', 'slug', 'site', 'xml_url', 'published', 'contacts'];
  protected $casts = [
    'contacts' => 'array',
    'published' => 'boolean',
  ];

  static function getVerboseContactType(array $contact)
  {
    return static::contactTypes[$contact['type']]['verbose'];
  }
  static function getStatusBySlug(string $status_slug)
  {
    return static::STATUS[$status_slug];
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function reviews()
  {
    return $this->hasMany(StoreReview::class);
  }

  public function getStatus(): array
  {
    return self::STATUS[$this->status];
  }
  public function getStatusValue($key)
  {
    return $this->getStatus()[$key];
  }
  public function setStatus(string $status_slug)
  {
    $this->status = $status_slug;
    $this->save();
  }

  public function setUpdateProgress(string|null $progress)
  {
    $this->update_progress = $progress;
    $this->save();
  }

  public function resetUpdateStatus()
  {
    $this->status = self::STATUS['updated']['value'];
    $this->update_progress = null;
    $this->save();
  }

  public function search_conversions()
  {
    return $this->hasMany(SearchConversion::class);
  }

  public function getReviewsReport()
  {
    $total_count = $this->reviews->count();
    $report = [];

    for ($i = 1; $i <= 5; $i++) {
      $report[$i] = [
        'count' => $count = $this->reviews->where('stars', $i)->count(),
        'percent' => $percent = $total_count > 0 ? (int) round($count / ($total_count / 100)) : 0,
        'text' => "$i star, $count reviews ($percent%)"
      ];
    }
    return $report;
  }

  public function recalculate_rate()
  {
    $has_reviews = $this->reviews->count() > 0;
    if ($has_reviews) {
      $avg_rate = $this->reviews->avg('stars');
      $this->rate = $avg_rate;
    } else {
      $this->rate = 0;
    }
    $this->save();
    return $avg_rate;
  }

  public function incr_rate()
  {
    $this->increment('reviews_count');
    $this->recalculate_rate();
    return $this->reviews_count;
  }

  public function decr_rate()
  {
    $this->decrement('reviews_count');
    $this->recalculate_rate();
    return $this->reviews_count;
  }

  public function getReviewsByStars(int|null $stars = null)
  {
    $reviews = $this->reviews();
    if ($stars !== null) $reviews->where('stars', $stars);
    return $reviews;
  }

  public function removeLogo()
  {
    $this->clearMediaCollection('logo');
  }

  public function logoUrl($conversion = null, $withFallback = false)
  {
    return Images::modelImageHandler($this, 'logo', $withFallback, $conversion);
  }

  public function popularSearches(int|null $limit = null)
  {
    $seraches = Search::leftJoin('search_conversions', 'searches.id', '=', 'search_conversions.search_id')
      ->selectRaw('searches.query_string as query_string, count(search_conversions.id) as conversions')
      ->groupBy('searches.id')
      ->orderBy('conversions');
    if ($limit !== null) $seraches->limit($limit);
    return $seraches;
  }

  public function popularProducts(int|null $limit = null)
  {
    $seraches = Product::leftJoin('search_conversions', 'products.id', '=', 'search_conversions.product_id')
      ->selectRaw('products.id as id, products.name as name, product_preview_id, count(search_conversions.id) as conversions')
      ->groupBy('products.id')
      ->orderBy('conversions');
    if ($limit !== null) $seraches->limit($limit);
    return $seraches;
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('logo')->singleFile();
  }
  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('h35')
      ->height(35)
      ->performOnCollections('logo');

    $this->addMediaConversion('h70')
      ->height(70)
      ->performOnCollections('logo');
  }
  public function getFormattedRate()
  {
    return sprintf('%0.1f', $this->rate);
  }
}

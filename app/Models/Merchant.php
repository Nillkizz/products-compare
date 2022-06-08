<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use App\Models\Traits\Slugable;
use Helpers\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Merchant extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia, Searchable, Slugable;

  const SEARCH_COLUMN = 'name';

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

  static function getVerboseContactType($contact)
  {
    return static::contactTypes[$contact['type']]['verbose'];
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function reviews()
  {
    return $this->hasMany(MerchantReview::class);
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
    return $this->update(['rate' => $this->reviews->avg('stars')]);
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
      ->selectRaw('products.id as id, products.name as name, count(search_conversions.id) as conversions')
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
}

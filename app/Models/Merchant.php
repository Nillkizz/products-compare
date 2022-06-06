<?php

namespace App\Models;

use Helpers\Images;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Merchant extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;
  const contactTypes = [
    ['value' => 'phone', 'verbose' => 'Phone'],
    ['value' => 'email', 'verbose' => 'Email'],
    ['value' => 'address', 'verbose' => 'Address']
  ];

  protected $fillable = ['name', 'slug', 'site', 'xml_url', 'published', 'contacts'];
  protected $casts = [
    'contacts' => 'array',
    'published' => 'boolean',
  ];

  public function products()
  {
    return $this->hasMany(Product::class);
  }

  public function reviews()
  {
    return $this->hasMany(MerchantReview::class);
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('logo')->singleFile();
  }

  static function search($s)
  {
    return static::query()->where('name', 'LIKE', "%$s%");
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

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('h35')
      ->height(35)
      ->performOnCollections('logo');

    $this->addMediaConversion('h70')
      ->height(70)
      ->performOnCollections('logo');
  }

  public function logoUrl($conversion = null, $withFallback = false)
  {
    return Images::modelImageHandler($this, 'logo', $withFallback, $conversion);
  }
}

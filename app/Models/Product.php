<?php

namespace App\Models;

use Helpers\Images;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $guarded = [
    'id', 'created_at', 'updated_at', 'search_string'
  ];

  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }

  public function previewUrl($conversion = null, $withFallback = true)
  {
    return Images::modelImageHandler($this, 'preview', $withFallback, $conversion);
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('preview')->singleFile();
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('450x450')
      ->fit(Manipulations::FIT_FILL, 450, 450)
      ->performOnCollections('preview');
    $this->addMediaConversion('210x210')
      ->fit(Manipulations::FIT_FILL, 210, 210)
      ->performOnCollections('preview');
    $this->addMediaConversion('60x60')
      ->fit(Manipulations::FIT_FILL, 60, 60)
      ->performOnCollections('preview');
  }

  static function search($s)
  {
    return static::query()->where('search_string', 'LIKE', "%$s%");
  }

  public function scopePriceLimit(Builder $query, $price): Builder
  {
    return $query->where('price', '<=', $price);
  }
}

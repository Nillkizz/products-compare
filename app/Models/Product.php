<?php

namespace App\Models;

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

  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }

  public function previewUrl($conversion = null)
  {
    $media = $this->getFirstMedia('preview');
    if ($media == null) return env('FALLBACK_IMAGE_URL');
    if ($conversion == null) return $media->getUrl();
    if ($media->hasGeneratedConversion($conversion)) return $media->getUrl($conversion);
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('preview')->singleFile();
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('thumb')
      ->fit(Manipulations::FIT_CROP, 350, 300);
    $this->addMediaConversion('small_thumb')
      ->fit(Manipulations::FIT_CROP, 80, 80);
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

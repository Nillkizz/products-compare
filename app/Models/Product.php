<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    if ($conversion == null) return $media->getUrl();
    $preview = $media->hasGeneratedConversion($conversion) ? $media->getUrl($conversion) : '';
    return $preview;
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('preview')->singleFile();
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('300x250_cropped')->crop('crop-center', 300, 250);
    $this->addMediaConversion('80x80_cropped')->crop('crop-center', 80, 80);
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

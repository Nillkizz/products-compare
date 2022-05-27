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

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('preview')->singleFile();
  }

  public function registerMediaConversions(Media $media = null): void
  {
    $this->addMediaConversion('cropped')->crop('crop-center', 300, 250);
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

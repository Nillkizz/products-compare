<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Helpers\Images;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model
{
  use HasFactory, Searchable;

  const SEARCH_COLUMN = 'search_string';

  protected $guarded = [
    'id', 'created_at', 'updated_at', 'search_string'
  ];

  public function preview()
  {
    return $this->belongsTo(ProductPreview::class, 'product_preview_id');
  }

  public function store()
  {
    return $this->belongsTo(Store::class);
  }

  public function search_conversions()
  {
    return $this->hasMany(SearchConversion::class);
  }

  public function previewUrl($conversion = null, $withFallback = true)
  {
    if (!$this->preview()->exists()) return null;
    return Images::modelImageHandler($this->preview, 'preview', $withFallback, $conversion);
  }

  public function scopePriceLimit(Builder $query, $price): Builder
  {
    return $query->where('price', '<=', $price);
  }
}

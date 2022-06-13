<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductPreview extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['url'];

  public function products()
  {
    return $this->hasMany(Product::class);
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
    $this->addMediaConversion('85x85')
      ->fit(Manipulations::FIT_FILL, 85, 85)
      ->performOnCollections('preview');
    $this->addMediaConversion('60x60')
      ->fit(Manipulations::FIT_FILL, 60, 60)
      ->performOnCollections('preview');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Merchant extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $fillable = ['name', 'slug', 'site', 'xml_url'];

  public function contacts()
  {
    return $this->hasMany(MerchantContact::class);
  }

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
}

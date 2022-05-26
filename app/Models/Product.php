<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }

  public function registerMediaCollections(): void
  {
    $this->addMediaCollection('photo')->singleFile();
  }



  static function search($s)
  {
    return static::query()->where('search_string', 'LIKE', "%$s%");
  }
}

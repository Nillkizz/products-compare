<?php

namespace App\Models\Traits;

trait Slugable
{
  static function getBySlug($slug)
  {
    return static::whereSlug($slug)->first();
  }
  static function getBySlugOrFail($slug)
  {
    return static::whereSlug($slug)->firstOrFail();
  }

  static function whereSlug($slug)
  {
    return static::query()->where('slug', $slug);
  }
}

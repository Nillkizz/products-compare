<?php

namespace App\Models\Traits;

trait Searchable
{
  static function search($s)
  {
    return static::query()->where(self::SEARCH_COLUMN, 'LIKE', "%$s%");
  }
}

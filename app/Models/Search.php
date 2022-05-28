<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
  use HasFactory;

  /**
   * Increments queries count
   *
   * Update or create search row with provided query string. Then increments `queries` column value.
   *
   * @param String $s Query string
   * @return Integer Count of queries
   **/

  static function incrementByQS($s)
  {
    $search = self::unguarded(fn () => self::firstOrCreate(['query_string' => $s]));
    $search->increment('queries');
    return $search->queries;
  }
}

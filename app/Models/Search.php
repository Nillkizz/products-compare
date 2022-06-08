<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
  use HasFactory;

  public function getProducts()
  {
    return Product::search($this->query_string);
  }

  public function search_conversions()
  {
    return $this->hasMany(SearchConversion::class);
  }

  public function getFirstProduct()
  {
    $product = null;

    $products = $this->getProducts();
    if ($products->count() > 0) $product = $products->first();
    return $product;
  }

  public function getPreview($conversion = '60x60')
  {
    return $this->getPreviewByQs($this->query_string, $conversion);
  }

  static function getPreviewByQs($queryString = null, $conversion = '60x60')
  {
    $product = Product::search($queryString);
    $preview = ($product->count() > 0) ? $product->first()->previewUrl($conversion) : null;
    return $preview ?? env('FALLBACK_IMAGE_URL');
  }

  static function get_popular_queries($amount)
  {
    return self::orderBy('queries')
      ->limit(100)
      ->inRandomOrder()->limit($amount)->get()
      ->pluck('query_string')
      ->toArray();
  }


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

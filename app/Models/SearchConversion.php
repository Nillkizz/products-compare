<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchConversion extends Model
{
  use HasFactory;

  protected $fillable = ['search_id', 'store_id', 'product_id'];

  public function search()
  {
    $this->hasOne(search::class);
  }

  public function store()
  {
    $this->hasOne(Store::class);
  }
  public function product()
  {
    $this->hasOne(Product::class);
  }

  static function newConversion(Search $search, Store $store, Product $product)
  {
    return static::create(['search_id' => $search->id, 'store_id' => $store->id, 'product_id' => $product->id]);
  }
}

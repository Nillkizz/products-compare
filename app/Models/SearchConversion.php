<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchConversion extends Model
{
  use HasFactory;

  protected $fillable = ['search_id', 'merchant_id', 'product_id'];

  public function search()
  {
    $this->hasOne(search::class);
  }

  public function merchant()
  {
    $this->hasOne(Merchant::class);
  }
  public function product()
  {
    $this->hasOne(Product::class);
  }

  static function newConversion(Search $search, Merchant $merchant, Product $product)
  {
    return static::create(['search_id' => $search->id, 'merchant_id' => $merchant->id, 'product_id' => $product->id]);
  }
}

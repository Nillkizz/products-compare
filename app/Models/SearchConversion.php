<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchConversion extends Model
{
  use HasFactory;

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
}

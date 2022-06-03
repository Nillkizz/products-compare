<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantReview extends Model
{
  use HasFactory;

  public function merchant()
  {
    return $this->hasOne(Merchant::class);
  }
}

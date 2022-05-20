<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantContact extends Model
{
  use HasFactory;
  public function type()
  {
    return $this->belongsTo(ContactType::class);
  }
  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantContact extends Model
{
  use HasFactory;

  public $timestamps = false;


  public function type()
  {
    return $this->belongsTo(ContactType::class, 'contact_type_id');
  }

  public function merchant()
  {
    return $this->belongsTo(Merchant::class);
  }
}

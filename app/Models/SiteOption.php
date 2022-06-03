<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
  use HasFactory;


  protected $visible = ['id', 'name', 'value', 'updated_at'];
  protected $fillable = ['value'];
  protected $casts = [
    'value' => 'array'
  ];


  protected function serializeDate(DateTimeInterface $date)
  {
    return $date->format('Y-m-d');
  }

  static function get($name, $json = false)
  {
    $option =  static::where('name', $name);
    if ($option->count() == 0) return;
    $val =  $option->first()->value;

    if ($json) return json_decode($val);
    else return $val;
  }
}

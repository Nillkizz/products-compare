<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
  use HasFactory;


  protected $visible = ['id', 'name', 'json', 'updated_at'];
  protected $fillable = ['json'];
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
    $val =  json_decode($option->first()->json);
    return $val;
  }
}

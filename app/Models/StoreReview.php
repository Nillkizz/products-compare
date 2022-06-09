<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreReview extends Model
{
  use HasFactory;
  protected $casts = ['questions' => 'array'];
  const QUESTIONS = [
    [
      'question' => 'Goods match the description?',
      'answer' => 'Corresponds to the description'
    ],
    [
      'question' => 'Are you satisfied with the service?',
      'answer' => 'Satisfied with the service'
    ],
    [
      'question' => 'Are you satisfied with the delivery?',
      'answer' => 'Satisfied with the delivery'
    ]
  ];

  public function store()
  {
    return $this->belongsTo(Store::class);
  }
}

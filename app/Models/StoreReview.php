<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreReview extends Model
{
  use HasFactory;
  protected $fillable = ['stars', 'questions', 'text'];
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
  const STATUS = [
    'moderation' => [
      'value' => 'moderation',
      'verbose' => 'Moderation'
    ],
    'published' => [
      'value' => 'published',
      'verbose' => 'Published'
    ]
  ];

  public function store()
  {
    return $this->belongsTo(Store::class);
  }

  public function setStatus($statusSlug)
  {
    $this->status = self::STATUS[$statusSlug]['value'];
    $this->save();
  }
  public function isPublished()
  {
    return $this->status == self::STATUS['published']['value'];
  }

  public function isModeration()
  {
    return $this->status == self::STATUS['moderation']['value'];
  }
}

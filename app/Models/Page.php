<?php

namespace App\Models;

use App\Models\Interfaces\HasStatus;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements HasStatus
{
  use HasFactory, Searchable;

  const SEARCH_COLUMN = 'name';
  protected $fillable = [
    'name', 'title', 'path', 'description', 'content', 'status'
  ];
}

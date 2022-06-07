<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageService
{
  function __construct(string $path)
  {
    $this->path = $path;
    $this->instance = $this->retrieve_page();
  }

  protected function retrieve_page()
  {
    $where = [];

    if (!Auth::check()) $where[] = ['status', Page::STATUS_PUBLISHED];
    $where[] = ['path',  $this->path];
    return Page::where($where)->firstOrFail();
  }

  public function setMeta()
  {
    meta()
      ->set('title', $this->instance->title)
      ->set('description', $this->instance->description);
  }
}

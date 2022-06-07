<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Support\Facades\Auth;

class PageService
{
  function __construct(string $path, bool $findOrFail = true)
  {
    $this->findOrFail = $findOrFail;
    $this->path = $path;
    $this->instance = $this->retrieve_page();
  }

  protected function retrieve_page()
  {
    $where = [
      ['path',  $this->path]
    ];
    if (!Auth::check()) $where[] = ['status', Page::STATUS_PUBLISHED];

    if ($this->findOrFail) return Page::where($where)->firstOrFail();
    else return Page::where($where)->first();
  }

  public function getView()
  {
    return $this->instance->template;
  }

  public function setMeta()
  {
    meta()
      ->set('title', $this->instance->title)
      ->set('description', $this->instance->description);
  }

  public function exists()
  {
    return $this->instance !== null;
  }
}

<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Public\AbstractPublicPageController;
use App\Services\PageService;
use Illuminate\Http\Request;

class PageController extends AbstractPublicPageController
{
  public function show(Request $request, string $path)
  {
    $page = new PageService($path);
    $page->setMeta();

    $data = [
      'page' => $page->instance
    ];

    return view('public.page', $data);
  }
}

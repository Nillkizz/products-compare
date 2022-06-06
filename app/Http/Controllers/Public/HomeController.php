<?php

namespace App\Http\Controllers\Public;

use App\Models\SiteOption;
use Illuminate\Http\Request;

class HomeController extends AbstractPublicPageController
{
  public function show()
  {
    meta()->set('title', 'Home');

    $data = [
      'featuredQueries' => SiteOption::get('featured_queries', true)->value,
    ];

    return view('public.pages.home', $data);
  }
}

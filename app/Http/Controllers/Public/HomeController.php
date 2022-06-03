<?php

namespace App\Http\Controllers\Public;

use App\Models\SiteOption;
use Illuminate\Http\Request;

class HomeController extends PublicPageController
{
  public function show()
  {
    meta()->set('title', 'Home');

    $data = [
      'featuredCategories' => SiteOption::get('featured_categories', true)->value,
    ];

    return view('public.pages.home', $data);
  }
}

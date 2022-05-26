<?php

namespace App\Http\Controllers\Public;

use App\Models\SiteOption;
use Illuminate\Http\Request;

class HomeController extends PublicPageController
{
  public function show()
  {
    meta()
      ->set('title', 'Home');

    $featuredCategories = SiteOption::where('name', 'featured_categories')->get();
    $data = [
      'featuredCategories' => ($featuredCategories->count() > 0) ? unserialize($featuredCategories->first()->value) : null,
    ];
    return view('public.pages.home', $data);
  }
}

<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;

class HomeController extends PublicPageController
{
  public function show()
  {
    meta()
      ->set('title', 'Home');

    return view('public.pages.home');
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteOption;
use Illuminate\Http\Request;

class SiteOptionController extends AdminPageController
{
  public function list(Request $request)
  {
    meta()->set('title', 'Site options');
    return view('admin.pages.site-options');
  }
}

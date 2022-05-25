<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;

class PublicPageController extends PageController
{
  public function __construct()
  {
    parent::__construct();
  }
}

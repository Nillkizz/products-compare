<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\AbstractPageController;
use Illuminate\Http\Request;

class AbstractPublicPageController extends AbstractPageController
{
  public function __construct()
  {
    parent::__construct();
  }
}

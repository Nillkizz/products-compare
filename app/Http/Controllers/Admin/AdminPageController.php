<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;

class AdminPageController extends PageController
{
  public function __construct()
  {
    parent::__construct();
    meta()
      ->noIndex();
  }
}

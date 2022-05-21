<?php

namespace App\Http\Controllers;

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

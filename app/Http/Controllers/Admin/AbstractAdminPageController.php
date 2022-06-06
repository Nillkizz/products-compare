<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AbstractPageController;
use Illuminate\Http\Request;

class AbstractAdminPageController extends AbstractPageController
{
  public function __construct()
  {
    parent::__construct();
    meta()
      ->noIndex();
  }
}

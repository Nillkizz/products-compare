<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
  public function __construct()
  {
    meta()
      ->setRawTag("<link rel='shortcut icon' href='" . asset('static/images/favicons/favicon.png') . "'>")
      ->setRawTag("<link rel='shortcut icon' href='" . asset('static/images/favicons/favicon-192x192.png') . "'>")
      ->setRawTag("<link rel='shortcut icon' href='" . asset('static/images/favicons/apple-touch-icon-180x180.png') . "'>");
  }
}

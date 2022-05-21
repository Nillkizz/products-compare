<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends AdminPageController
{
  public function list()
  {
    meta()->set('title', 'Store Merchants');

    $merchants = Merchant::all();

    return view('admin.pages.merchants', compact('merchants'));
  }
}

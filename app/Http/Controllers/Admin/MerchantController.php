<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends AdminPageController
{
  public function index(Request $request)
  {
    meta()->set('title', 'Store Merchants');

    $data = [
      'merchants' => $this->get_products(),
      'allMerchantsCount' => Merchant::count()
    ];

    return view('admin.pages.merchants', $data);
  }

  public function get_products()
  {
    return Merchant::search(request('s'))->paginate();
  }
}

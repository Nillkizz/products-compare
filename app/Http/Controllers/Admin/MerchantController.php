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

    return view('admin.pages.merchants.index', $data);
  }

  public function edit(Request $request, Merchant $merchant)
  {
    meta()->set('title', 'Edit merchant "' . $merchant->name . '"');
    $data = ['merchant' => $merchant];

    return view('admin.pages.merchants.edit', $data);
  }

  public function update(Request $request, Merchant $merchant)
  {
    $merchant->update($request->only('name', 'slug', 'site', 'xml_url'));

    return redirect()->route('admin.merchants.edit', compact('merchant'))->with(['notify' => [
      'type' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }


  public function get_products()
  {
    return Merchant::search(request('s'))->paginate();
  }
}

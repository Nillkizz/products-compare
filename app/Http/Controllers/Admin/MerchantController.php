<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateMerchantFormRequest;
use App\Http\Requests\Admin\UpdateMerchantFormRequest;
use App\Models\Merchant;
use App\Services\XmlProducts;
use ErrorException;
use Illuminate\Http\Request;

class MerchantController extends AbstractAdminPageController
{
  public function index(Request $request)
  {
    meta()->set('title', 'Store Merchants');

    $data = [
      'merchants' => Merchant::search(request('s'))->paginate(16),
      'allMerchantsCount' => Merchant::count()
    ];

    return view('admin.pages.merchants.index', $data);
  }

  public function create(Request $request)
  {
    meta()->set('title', 'Add merchant');
    $data = [
      'contact_types' => Merchant::contactTypes
    ];

    return view('admin.pages.merchants.create', $data);
  }

  public function store(CreateMerchantFormRequest $request)
  {
    $merchant = Merchant::create($request->validated());
    if ($request->hasFile('logo')) $merchant->addMediaFromRequest('logo')->toMediaCollection('logo');

    return redirect()->route('admin.merchants.edit', compact('merchant'))->with(['notify' => [
      'status' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }

  public function edit(Request $request, Merchant $merchant)
  {
    meta()->set('title', 'Edit merchant "' . $merchant->name . '"');
    $data = compact('merchant');

    return view('admin.pages.merchants.edit', $data);
  }

  public function update(UpdateMerchantFormRequest $request, Merchant $merchant)
  {
    $merchant->update($request->validated());
    if ($request->hasFile('logo')) $merchant->addMediaFromRequest('logo')->toMediaCollection('logo');

    return redirect()->route('admin.merchants.edit', compact('merchant'))->with(['notify' => [
      'status' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }

  public function destroy(Request $request, Merchant $merchant)
  {
    return $merchant->delete();
  }


  public function do_xml_import_products(Request $request, Merchant $merchant)
  {
    $notify = [
      'status' => 'success',
      'icon' => '',
      'text' => 'Import has been succesfull'
    ];

    try {
      $xmlProducts = new XmlProducts($merchant->xml_url);
      $products = $xmlProducts->importFor($merchant);
    } catch (ErrorException $e) {
      $notify = [
        'status' => 'danger',
        'icon' => '',
        'text' => "Can't reach the file"
      ];
    }

    return redirect()->route('admin.merchants.edit', compact('merchant'))->with(compact('notify'));
  }
}

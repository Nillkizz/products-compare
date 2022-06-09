<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Stores\CreateStoreFormRequest;
use App\Http\Requests\Admin\Stores\UpdateStoreFormRequest;
use App\Models\Store;
use App\Services\XmlProducts;
use ErrorException;
use Illuminate\Http\Request;

class StoreController extends AbstractAdminPageController
{
  public function index(Request $request)
  {
    meta()->set('title', 'Store Stores');

    $data = [
      'stores' => Store::search(request('s'))->paginate(16),
      'allStoresCount' => Store::count()
    ];

    return view('admin.pages.stores.index', $data);
  }

  public function create(Request $request)
  {
    meta()->set('title', 'Add store');
    $data = [
      'contact_types' => Store::contactTypes
    ];

    return view('admin.pages.stores.create', $data);
  }

  public function store(CreateStoreFormRequest $request)
  {
    $store = Store::create($request->validated());
    if ($request->hasFile('logo')) $store->addMediaFromRequest('logo')->toMediaCollection('logo');

    return redirect()->route('admin.stores.edit', compact('store'))->with(['notify' => [
      'status' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }

  public function edit(Request $request, Store $store)
  {
    meta()->set('title', 'Edit store "' . $store->name . '"');
    $data = compact('store');

    return view('admin.pages.stores.edit', $data);
  }

  public function update(UpdateStoreFormRequest $request, Store $store)
  {
    switch ($request->get('action')) {
      case 'removeLogo':
        $store->removeLogo();
        break;
      default:
        $store->update($request->validated());
        if ($request->hasFile('logo')) $store->addMediaFromRequest('logo')->toMediaCollection('logo');
    }

    return redirect()->route('admin.stores.edit', compact('store'))->with(['notify' => [
      'status' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }

  public function destroy(Request $request, Store $store)
  {
    return $store->delete();
  }


  public function do_xml_import_products(Request $request, Store $store)
  {
    $notify = [
      'status' => 'success',
      'icon' => '',
      'text' => 'Import has been succesfull'
    ];

    try {
      $xmlProducts = new XmlProducts($store->xml_url);
      $products = $xmlProducts->importFor($store);
    } catch (ErrorException $e) {
      $notify = [
        'status' => 'danger',
        'icon' => '',
        'text' => "Can't reach the file"
      ];
    }

    return redirect()->route('admin.stores.edit', compact('store'))->with(compact('notify'));
  }
}

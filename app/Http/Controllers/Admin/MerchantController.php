<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    $validated = Validator::make($request->all(), [
      'name' => 'required|max:255',
      'slug' => [
        'required', 'max:255',
        Rule::unique('merchants')->ignore($merchant->id),
        ''
      ],
      'site' => [
        'required', 'max:255',
        Rule::unique('merchants')->ignore($merchant->id),
      ],
      'xml_url' => [
        'required', 'URL',
        Rule::unique('merchants')->ignore($merchant->id),
      ],
    ])
      ->validated();
    $validated['published'] = $request->has('published');

    if ($request->hasFile('logo')) $merchant->addMediaFromRequest('logo')->toMediaCollection('logo');
    $merchant->update($validated);

    return redirect()->route('admin.merchants.edit', compact('merchant'))->with(['notify' => [
      'type' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }


  private function get_products()
  {
    return Merchant::search(request('s'))->paginate();
  }
}

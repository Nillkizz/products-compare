<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteOption;
use Illuminate\Http\Request;

class SiteOptionController extends AdminPageController
{
  public function index(Request $request)
  {
    meta()->set('title', 'Site options');
    $data = [
      'options' => SiteOption::all()
    ];

    return view('admin.pages.site-options', $data);
  }

  public function update(Request $request, SiteOption $option)
  {
    $option->update([
      'value' => json_decode($request->value)
    ]);

    // auth()->user()->notify(new NewMessage(Booking::findOrFail($id)));

    // notification
    return redirect()->route('admin.settings.siteoptions')->with(['notify' => [
      'type' => 'success',
      'icon' => '',
      'text' => 'Changes saved'
    ]]);
  }
}

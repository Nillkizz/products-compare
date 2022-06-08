<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GoToProductController extends Controller
{
  function reloadToShop(Request $request)
  {
    $product = Product::where(['id' => $request->get('product')])->firstOrFail();
    $data = [
      'site' => $product->merchant->site,
      'target_url' => $product->link,
    ];
    return view('reload-to-shop', $data);
  }
}

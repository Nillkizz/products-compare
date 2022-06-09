<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Search;
use App\Models\SearchConversion;
use Illuminate\Http\Request;

class GoToProductController extends Controller
{
  function reloadToShop(Request $request)
  {
    $search = Search::firstOrCreate(['query_string' => $request->input('search')]);
    $product = Product::where(['id' => $request->get('product')])->firstOrFail();

    SearchConversion::newConversion($search, $product->store, $product);

    $data = [
      'site' => $product->store->site,
      'target_url' => $product->link,
    ];
    return view('reload-to-shop', $data);
  }
}

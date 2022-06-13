<?php

namespace App\Http\Controllers\Public;

use App\Models\Store;
use App\Models\Search;
use Illuminate\Http\Request;

class StoreController extends AbstractPublicPageController
{
  public function show(Request $request, Store $store)
  {
    $store_logo = $store->logoUrl('h70');

    $data = [
      'rate' => $store->getFormattedRate(),
      'hasLogo' => !empty($store_logo),
      'logo' => $store_logo,
      'store' => $store,
      'contacts' => $store->contacts,
      'reviews' => $store->getReviewsByStars($request->input('stars'))->paginate(20),
      'reviewsStars' => $request->input('stars'),
      'popularSearches' => $store->popularSearches(8)->get(),
      'popularProducts' => $store->popularProducts(8)->get(),
      'review_leaved' => in_array($store->id, session('reviewed-stores', []))
    ];

    meta()->set('title', 'Store ' . $store->site);
    meta()->set('description', 'Store ' . $store->site . 'reviews and description. Rating ' . $data['rate'] . ' out of 5');
    return view('public.pages.store', $data);
  }
}

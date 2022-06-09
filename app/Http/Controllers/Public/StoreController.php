<?php

namespace App\Http\Controllers\Public;

use App\Models\Store;
use App\Models\Search;
use Illuminate\Http\Request;

class StoreController extends AbstractPublicPageController
{
  public function show(Request $request, string $slug)
  {
    $store = Store::getBySlugOrFail($slug);
    $store_logo = $store->logoUrl('h70');

    $data = [
      'hasLogo' => !empty($store_logo),
      'logo' => $store_logo,
      'store' => $store,
      'contacts' => $store->contacts,
      'reviews' => $store->getReviewsByStars($request->input('stars'))->paginate(20),
      'reviewsStars' => $request->input('stars'),
      'popularSearches' => $store->popularSearches(8)->get(),
      'popularProducts' => $store->popularProducts(8)->get()
    ];

    meta()->set('title', 'Store ' . $store->site);
    return view('public.pages.store', $data);
  }
}

<?php

namespace App\Http\Controllers\Public;

use App\Models\Merchant;
use App\Models\Search;
use Illuminate\Http\Request;

class MerchantController extends AbstractPublicPageController
{
  public function show(Request $request, string $slug)
  {
    $merchant = Merchant::getBySlugOrFail($slug);
    $merchant_logo = $merchant->logoUrl('h70');

    $data = [
      'hasLogo' => !empty($merchant_logo),
      'logo' => $merchant_logo,
      'merchant' => $merchant,
      'contacts' => $merchant->contacts,
      'reviews' => $merchant->reviews()->paginate(20),
      'popularSearches' => $merchant->popularSearches(8)->get(),
      'popularProducts' => $merchant->popularProducts(8)->get()
    ];

    meta()->set('title', 'Merchant ' . $merchant->site);
    return view('public.pages.merchant', $data);
  }
}

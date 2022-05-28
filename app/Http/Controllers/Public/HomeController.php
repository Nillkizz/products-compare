<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\SiteOption;
use Illuminate\Http\Request;

class HomeController extends PublicPageController
{
  public function show()
  {
    meta()->set('title', 'Home');

    $featuredCategories = array_map([$this, '_addPreviewToSearch'], SiteOption::get('featured_categories'));
    $data = [
      'featuredCategories' => $featuredCategories,
    ];
    return view('public.pages.home', $data);
  }

  private function _addPreviewToSearch($s)
  {
    $product = Product::search($s);
    $preview = null;
    if ($product->count() > 0) $preview = $product->first()->previewUrl('small_thumb');
    return ['value' => $s, 'preview' => $preview];
  }
}

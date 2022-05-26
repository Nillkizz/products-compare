<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends PublicPageController
{
  public function show(Request $request)
  {
    $title = empty(request('s')) ? 'Catalog' : "Search " . '"' . request('s') . '"';
    meta()->set('title', $title);

    $data = [
      'products' => $this->get_products(),
    ];

    return view('public.pages.search', $data);
  }

  public function get_products()
  {
    $products = Product::search(request('s'));

    return QueryBuilder::for($products)
      ->defaultSort('name')
      ->allowedSorts('price', 'name')
      ->allowedFilters([
        AllowedFilter::scope('price_limit')
      ])
      ->paginate();
  }
}

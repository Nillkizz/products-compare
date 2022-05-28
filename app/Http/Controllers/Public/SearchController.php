<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\Search;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends PublicPageController
{
  public function show(Request $request)
  {
    $search = request('s');
    $isFirstQueryForSession = !in_array($search, session('search_history', []));


    $title = empty($search) ? 'Catalog' : "Search " . '"' . request($search) . '"';
    meta()->set('title', $title);

    if (!empty($search) && $isFirstQueryForSession) {
      session()->push('search_history', $search);
      Search::incrementByQS($search);
    }

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

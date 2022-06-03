<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\Search;
use App\Models\SiteOption;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends PublicPageController
{
  public function show(Request $request)
  {
    $data = [
      'hasProducts' => false
    ];
    $search = request('s');
    $data['hasSearch'] = $hasSearch = !empty($search);


    if ($hasSearch) {
      $title = "Search " . '"' . $search . '"';
      $isFirstQueryForSession = !in_array($search, session('search_history', []));
      if (!empty($search) && $isFirstQueryForSession) {
        session()->push('search_history', $search);
        Search::incrementByQS($search);
      }
      $data['products'] = $products = $this->get_products();
      $data['hasProducts'] = $products->count() > 0;
    } else {
      $title = 'Catalog';
    }

    if (!$data['hasProducts']) {
      $queries = Search::get_popular_queries(6);
      if (empty($queries)) $queries = SiteOption::get('featured_categories', true)->value;
      $data['popular_queries'] = $queries;
    }

    meta()->set('title', $title);
    return view('public.pages.search', $data);
  }


  private function get_products()
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

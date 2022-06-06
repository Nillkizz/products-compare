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
    $show_erotic_items = session('show_erotic_items', false);
    $data = [
      'hasProducts' => false,
      'show_erotic_items' => $show_erotic_items,
      'has_erotic_items' => false
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
      $data['products'] = $products = Product::search(request('s'));
      $data['hasProducts'] = $products->exists();

      if (!$show_erotic_items) {
        $without_adults = (clone $products)->where('adult', false);
        $data['has_erotic_items'] = $products->count() > $without_adults->count();
        $products = $without_adults;
      }

      $data['products'] = QueryBuilder::for($products)
        ->defaultSort('name')
        ->allowedSorts('price', 'name')
        ->allowedFilters([
          AllowedFilter::scope('price_limit')
        ])->paginate(16);
    } else {
      $title = 'Catalog';
    }

    if (!$data['hasProducts']) {
      $queries = Search::get_popular_queries(6);
      if (empty($queries)) $queries = SiteOption::get('featured_queries', true)->value;
      $data['popular_queries'] = $queries;
    }


    meta()->set('title', $title);

    return view('public.pages.search', $data);
  }

  public function show_erotic_items(Request $request)
  {
    if ($request->has('show_erotic_items')) session()->push('show_erotic_items', true);
    return $this->show($request);
  }
}

<?php

namespace App\Http\Controllers\Public;

use App\Models\Product;
use App\Models\Search;
use App\Models\SiteOption;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SearchController extends AbstractPublicPageController
{
  public function show(Request $request)
  {
    $searchService = new SearchService(request('s'));
    $data = $searchService->getData();

    $searchService->setMeta();
    return view('public.pages.search', $data);
  }

  public function show_erotic_items(Request $request)
  {
    if ($request->has('show_erotic_items')) session()->push('show_erotic_items', true);
    return $this->show($request);
  }
}

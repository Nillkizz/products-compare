<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends AdminPageController
{
  public function list(Request $request)
  {
    meta()->set('title', 'Store Products');

    $data = [
      'products' => $this->get_products(),
      'filters' => $this->get_filters($request->getQueryString()),
      'allProductsCount' => Product::count()
    ];

    return view('admin.pages.products', $data);
  }

  public function get_products()
  {
    return QueryBuilder::for(Product::search(request('s')))
      ->defaultSort('created_at')
      ->allowedSorts('id', 'price', 'name', 'created_at')
      ->allowedFilters(
        [
          AllowedFilter::exact('adult'),
          AllowedFilter::exact('used'),
          AllowedFilter::exact('over_the_counter_medicine'),
        ]
      )->paginate(16);
  }

  public function get_filters($query)
  {
    // $query = empty($query) ? '' : '&' . $query;
    // $get_link = fn ($q, $v) => "?filter[$q]=$v" . $query;
    $get_link = fn ($q, $v) => "?filter[$q]=$v";
    return [
      [
        'name' => 'All',
        'link' => '?'
      ],
      [
        'name' => 'Used',
        'link' => $get_link('used', 1)
      ],
      [
        'name' => 'Not Used',
        'link' => $get_link('used', 0)
      ],
      [
        'name' => 'Adult',
        'link' => $get_link('adult', 1)
      ],
      [
        'name' => 'Medecine',
        'link' => $get_link('over_the_counter_medicine', 1)
      ],
    ];
  }
}

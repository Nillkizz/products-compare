<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends AbstractAdminPageController
{
  public function show()
  {
    meta()
      ->set('title', 'Admin Dashboard');

    $data = [
      'card-counters' => [
        [
          'title' => 'Products',
          'class' => 'col-6 col-sm-3',
          'icon' => 'fa-box',
          'value' => Product::count(),
          'link' => 'Go to products',
          'url' => route('admin.products')
        ],
        [
          'title' => 'Stores',
          'class' => 'col-6 col-sm-3',
          'icon' => 'fa-store',
          'value' => Store::count(),
          'link' => 'Go to stores',
          'url' => route('admin.stores.index')
        ]
      ]
    ];
    return view('admin.pages.dashboard', compact('data'));
  }
}

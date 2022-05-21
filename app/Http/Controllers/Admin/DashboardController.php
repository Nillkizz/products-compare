<?php

namespace App\Http\Controllers\Admin;

use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends AdminPageController
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
          'title' => 'Merchants',
          'class' => 'col-6 col-sm-3',
          'icon' => 'fa-store',
          'value' => Merchant::count(),
          'link' => 'Go to merchants',
          'url' => route('admin.merchants')
        ]
      ]
    ];
    return view('admin.pages.dashboard', compact('data'));
  }
}

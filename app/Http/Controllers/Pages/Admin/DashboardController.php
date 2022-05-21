<?php

namespace App\Http\Controllers\Pages\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use League\CommonMark\Extension\Attributes\Node\Attributes;

class DashboardController extends Controller
{
  public function show()
  {
    $data = [
      'card-counters' => [
        [
          'title' => 'Products',
          'class' => 'col-3',
          'icon' => 'fa-box',
          'value' => Product::count(),
          'link' => 'Go to products',
          'url' => '#'
        ]
      ]
    ];
    return view('admin.pages.dashboard', compact('data'));
  }
}

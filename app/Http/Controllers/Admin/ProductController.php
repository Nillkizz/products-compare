<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AdminPageController
{
  public function list()
  {
    meta()->set('title', 'Store Products');

    $products = Product::all();

    return view('admin.pages.products', compact('products'));
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminPageController
{
  public function list()
  {
    meta()->set('title', 'Store Categories');

    $categories = Category::all();

    return view('admin.pages.categories', compact('categories'));
  }
}

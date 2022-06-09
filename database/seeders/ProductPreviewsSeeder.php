<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    foreach (Product::all() as $product) {
      $product
        ->addMediaFromUrl('http://placekitten.com/' . rand(200, 500) . '/' . rand(200, 500))
        ->toMediaCollection('preview');
    };
  }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SiteOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteOptionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $count = rand(10, 20);
    $featuredProductsId = Product::all()->random($count)->map(fn ($product) => $product->name)->toArray();
    SiteOption::factory(1)
      ->state(['name' => 'featured_products', 'value' => serialize($featuredProductsId)])
      ->create();
  }
}

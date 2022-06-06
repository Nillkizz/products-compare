<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SiteOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

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
    $product_names = Product::inRandomOrder()->limit($count)->pluck('name')->toArray();
    $featuredQueries = ['value' => array_map(fn ($n) => Arr::random(explode(' ', $n)), $product_names), 'type' => 'multivalue'];
    SiteOption::updateOrCreate(
      ['name' => 'featured_queries'],
      ['json' => $featuredQueries]
    );
  }
}

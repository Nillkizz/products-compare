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
    $featuredProductNames = Product::inRandomOrder()->limit($count)->pluck('name')->toArray();
    SiteOption::updateOrCreate(
      ['name' => 'featured_categories'],
      ['value' => $featuredProductNames]
    );
  }
}

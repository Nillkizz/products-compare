<?php

namespace Database\Seeders;

use App\Models\Merchant;
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
    foreach (Merchant::all() as $merchant) {
      Product::factory(rand(0, 50))
        ->for($merchant)
        ->create();
      // ->each(function ($product) {
      //   $url = 'https://dummyimage.com/250/ffffff/000000';
      //   $product
      //     ->addMediaFromUrl($url)
      //     ->toMediaCollection('preview');
      // });
    };
  }
}

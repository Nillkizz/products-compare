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
    $merchants = Merchant::all();

    foreach ($merchants as $merchant) {
      Product::factory(rand(0, 50))
        ->state([
          'merchant_id' => $merchant->id
        ])
        ->create();
    }
  }
}

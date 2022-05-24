<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\MerchantContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantContactSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    foreach (Merchant::all() as $merchant) {
      MerchantContact::factory(rand(0, 3))->for($merchant)->create();
    };
  }
}

<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\MerchantReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Merchant::factory()
      ->count(8)
      ->create()
      ->each(fn ($merchant) => MerchantReview::factory()->for($merchant)->count(rand(0, 10))->create());
  }
}

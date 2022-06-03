<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      FixtureSeeder::class,

      MerchantSeeder::class,
      MerchantContactSeeder::class,

      // ProductSeeder::class,

      // SiteOptionSeeder::class,
    ]);
  }
}

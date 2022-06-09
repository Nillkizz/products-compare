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

      StoreSeeder::class,
      ProductSeeder::class,
      SearchSeeder::class,
      SearchConversionSeeder::class,
      SiteOptionSeeder::class,
    ]);
  }
}

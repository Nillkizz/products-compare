<?php

namespace Database\Seeders;

use App\Models\SearchConversion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SearchConversionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    SearchConversion::factory(500)->create();
  }
}

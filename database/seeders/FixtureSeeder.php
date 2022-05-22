<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class FixtureSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::factory()
      ->state([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'password' => bcrypt('password')
      ])
      ->create();

    Category::factory()
      ->state([
        'name' => 'Uncategorized',
        'slug' => 'uncategorized'
      ])
      ->create();
  }
}

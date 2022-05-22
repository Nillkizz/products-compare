<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        'password' => Hash::make('password')
      ])
      ->create();
  }
}

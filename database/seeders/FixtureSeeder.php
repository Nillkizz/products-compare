<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ContactType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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

    ContactType::factory(3)
      ->state(new Sequence(
        ['name' => 'Email'],
        ['name' => 'Phone'],
        ['name' => 'Address']
      ))
      ->create();
  }
}

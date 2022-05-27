<?php

namespace Database\Seeders;

use App\Models\ContactType;
use App\Models\SiteOption;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FixtureSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    File::cleanDirectory(storage_path('media'));

    User::factory()
      ->state([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'password' => bcrypt('password')
      ])
      ->create();

    ContactType::factory(3)
      ->state(new Sequence(
        ['name' => 'Email'],
        ['name' => 'Phone'],
        ['name' => 'Address']
      ))
      ->create();


    SiteOption::factory(1)
      ->state(['name' => 'featured_categories', 'value' => json_encode([])])
      ->create();
  }
}

<?php

namespace Database\Seeders;

use App\Models\Page;
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
    File::cleanDirectory(storage_path('app/public/media'));

    User::factory()
      ->state([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'password' => bcrypt('password')
      ])
      ->create();


    require storage_path('/assets/pages.php');
    Page::factory(count($pages))->state(new Sequence(...$pages))->create();


    SiteOption::factory(1)
      ->state(['name' => 'featured_queries', 'json' => '{ "value": [], "type": "multivalue" }'])
      ->create();
  }
}

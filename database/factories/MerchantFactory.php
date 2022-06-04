<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
 */
class MerchantFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => $name = Str::ucfirst($this->faker->unique()->word()),
      'slug' => Str::slug($name),
      'site' => $this->faker->unique()->domainName(),
      'xml_url' => $this->faker->unique()->url(),
      // TODO: Add published column
      // 'published' => $this->faker->boolean(80),
    ];
  }
}

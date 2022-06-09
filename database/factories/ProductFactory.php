<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'store_id' => 1,
      'name' => $this->faker->words(2, true),
      'price' => $this->faker->randomNumber(4),
      'link' => $this->faker->unique()->url(),
      'category_full' => $this->faker->sentence(),
      'category_link' => (30 > rand(0, 100)) ? null : $this->faker->url(),
      'in_stock' => (30 > rand(0, 100)) ? null : rand(0, 10),
      'brand' => (30 > rand(0, 100)) ? null : $this->faker->word(),
      'model' => (30 > rand(0, 100)) ? null : $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
      'color' => (30 > rand(0, 100)) ? null : $this->faker->colorName(),
      'mpn' => (30 > rand(0, 100)) ? null : $this->faker->lexify(),
      'gtin' => (30 > rand(0, 100)) ? null : $this->faker->lexify(),
      'used' => (10 > rand(0, 100)),
      'adult' => (10 > rand(0, 100)),
      'over_the_counter_medicine' => (5 < rand(0, 100)),
    ];
  }
}

<?php

namespace Database\Factories;

use App\Models\Category;
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
      'merchant_id' => 1,
      'category_id' => Category::get()->random()->id,
      'name' => $this->faker->words(2, true),
      'slug' => $this->faker->unique()->slug()
    ];
  }
}

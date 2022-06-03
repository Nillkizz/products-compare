<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantReview>
 */
class MerchantReviewFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'stars' => $this->faker->numberBetween(1, 5),
      'is_good_service' => $this->faker->boolean(),
      'is_good_delivery' => $this->faker->boolean(),
      'is_correspond_description' => $this->faker->boolean(),
      'text' => $this->faker->paragraph()
    ];
  }
}

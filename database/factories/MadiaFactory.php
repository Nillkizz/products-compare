<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteOptions>
 */
class MediaFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    // Product
    return [
      'model' => 'App\Models\Product',
      'uuid' => $uuid = $this->faker->unique()->uuid(),
      'collection_name' => 'preview',
      'name' => $this->faker->word(),
      'file_name' => $uuid . '.png',
      'mime_type' => 'image/png',

    ];
  }
}

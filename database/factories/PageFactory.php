<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => $name = $this->faker->sentence(),
      'path' => $this->faker->unique()->word(),
      'title' => $name,
      'template' => $this->faker->randomElement(Page::getTemplates()),
      'description' => $this->faker->paragraphs(3, true),
      'content' => $this->faker->realText(),
      'status' => $this->faker->randomElement(Page::STATUSES)
    ];
  }
}

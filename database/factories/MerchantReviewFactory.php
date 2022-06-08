<?php

namespace Database\Factories;

use App\Models\MerchantReview;
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
    $questions = array_map(function ($q) {
      return ['question' => $q['question'], 'answer' => $this->faker->boolean(), 'text' => $q['answer']];
    }, $this->faker->randomElements(MerchantReview::QUESTIONS, rand(0, count(MerchantReview::QUESTIONS))));

    return [
      'stars' => $this->faker->numberBetween(1, 5),
      'questions' => $questions,
      'text' => $this->faker->paragraph()
    ];
  }
}

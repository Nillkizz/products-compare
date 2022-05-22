<?php

namespace Database\Factories;

use App\Models\ContactType;
use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MerchantContact>
 */
class MerchantContactFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'value' => $this->faker->word(),
      'contact_type_id' => ContactType::get()->random()->id,
      'merchant_id' => Merchant::get()->random()->id
    ];
  }
}

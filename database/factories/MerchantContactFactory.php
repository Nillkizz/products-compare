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
      'merchant_id' => Merchant::get()->random()->id,
      'contact_type_id' => ($contactType = ContactType::get()->random())->id,
      'value' => $this->get_value_by_type($contactType),
    ];
  }

  public function get_value_by_type($type)
  {
    switch ($type->name) {
      case 'Email':
        return $this->faker->companyEmail();
      case 'Phone':
        return $this->faker->phoneNumber();
      case 'Address':
        return $this->faker->address();
      default:
        return $this->faker->word();
    }
  }
}

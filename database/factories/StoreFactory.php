<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'name' => $name = Str::ucfirst($this->faker->unique()->domainWord()),
      'slug' => Str::slug($name),
      'site' => $this->faker->unique()->domainName(),
      'xml_url' => $this->faker->unique()->url(),
      'published' => $this->faker->boolean(80),
      'contacts' => $this->get_contacts(),
    ];
  }

  public function get_contact_by_type($type)
  {
    switch ($type) {
      case 'email':
        return $this->faker->companyEmail();
      case 'phone':
        return $this->faker->phoneNumber();
      case 'address':
        return $this->faker->address();
      default:
        return $this->faker->word();
    }
  }

  public function get_contacts()
  {
    $types = Arr::pluck(Arr::random(Store::contactTypes, rand(0, count(Store::contactTypes))), 'value');
    $contacts = [];
    foreach ($types as $type) array_push($contacts, $this->get_contact($type));

    return $contacts;
  }

  public function get_contact($type)
  {
    return ['type' => $type, 'value' => $this->get_contact_by_type($type)];
  }
}

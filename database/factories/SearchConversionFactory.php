<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Product;
use App\Models\Search;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchConversions>
 */
class SearchConversionFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'search_id' => Search::all()->random()->id,
      'store_id' => Store::all()->random()->id,
      'product_id' => Product::all()->random()->id,
    ];
  }
}

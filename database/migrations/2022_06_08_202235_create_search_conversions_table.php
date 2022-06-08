<?php

use App\Models\Merchant;
use App\Models\Product;
use App\Models\Search;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('search_conversions', function (Blueprint $table) {
      $table->id();

      $table->foreignIdFor(Search::class);

      $table->foreignIdFor(Merchant::class);
      $table->foreignIdFor(Product::class);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('search_conversions');
  }
};

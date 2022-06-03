<?php

use App\Models\Merchant;
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
    Schema::create('merchant_reviews', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignIdFor(Merchant::class);
      $table->smallInteger('stars');
      $table->boolean('is_good_service');
      $table->boolean('is_good_delivery');
      $table->boolean('is_correspond_description');
      $table->text('text');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('merchant_reviews');
  }
};

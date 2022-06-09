<?php

use App\Models\Store;
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
    Schema::create('store_reviews', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignIdFor(Store::class);
      $table->smallInteger('stars');
      $table->json('questions');
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
    Schema::dropIfExists('store_reviews');
  }
};

<?php

use App\Models\Store;
use App\Models\StoreReview;
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

      $table->foreignIdFor(Store::class);

      $table->smallInteger('stars');
      $table->json('questions');
      $table->text('text')->nullable();

      $table->string('status')->default(StoreReview::STATUS['moderation']['value']);

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
    Schema::dropIfExists('store_reviews');
  }
};

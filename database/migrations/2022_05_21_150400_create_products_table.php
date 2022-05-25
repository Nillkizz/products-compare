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
    Schema::create('products', function (Blueprint $table) {
      $table->id();

      $table->string('name', 200);
      $table->double('price');
      $table->string('link', 500)->unique();

      $table->string('category_full', 200)->nullable();
      $table->string('category_link', 500)->nullable();
      $table->double('in_stock')->nullable();
      $table->string('brand')->nullable();
      $table->string('model')->nullable();
      $table->string('color')->nullable();
      $table->string('mpn')->nullable();
      $table->string('gtin')->nullable();

      $table->boolean('used')->default(false);
      $table->boolean('adult')->default(false);
      $table->boolean('over_the_counter_medicine')->default(false);
      $table->boolean('is_active')->default(true);
      $table->boolean('is_featured')->default(false);

      $table->foreignIdFor(Merchant::class);
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
    Schema::dropIfExists('products');
  }
};

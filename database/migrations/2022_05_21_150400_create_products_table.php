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
      $table->decimal('price')->indexed();
      $table->string('link', 500);

      $table->string('category_full', 200)->nullable();
      $table->string('category_link', 500)->nullable();
      $table->string('image_url', 500)->nullable();
      $table->integer('in_stock')->nullable();
      $table->string('brand')->nullable();
      $table->string('model')->nullable();
      $table->string('color')->nullable();
      $table->string('mpn')->nullable();
      $table->string('gtin')->nullable();

      $table->boolean('used')->default(false);
      $table->boolean('adult')->default(false);
      $table->boolean('over_the_counter_medicine')->default(false);

      $table->foreignIdFor(Merchant::class)->constrained()->cascadeOnDelete();
      $table->timestamps();

      $table->longText('search_string')->storedAs(
        "CONCAT_WS(' ', name, IFNULL(category_full, ''), IFNULL(brand, ''), IFNULL(model, ''), IFNULL(color, ''), IFNULL(mpn, ''), IFNULL(gtin, ''))"
      )->indexed();
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

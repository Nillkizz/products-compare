<?php

use App\Models\Category;
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
      $table->string('name');
      $table->double('price');
      $table->string('slug')->unique();
      $table->boolean('is_active')->default(true);
      $table->boolean('is_featured')->default(false);
      $table->foreignIdFor(Merchant::class);
      $table->foreignIdFor(Category::class);
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

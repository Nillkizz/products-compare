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
      $table->timestamps();
      $table->foreignIdFor(Merchant::class);
      $table->foreignIdFor(Category::class);
      $table->string('name');
      $table->string('slug')->unique();
      $table->boolean('is_active')->default(true);
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

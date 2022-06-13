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
    Schema::create('stores', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug')->unique();
      $table->string('site')->unique();
      $table->string('xml_url')->unique();
      $table->json('contacts')->required();

      $table->string('status')->default(Store::getStatusBySlug('updated')['value']);
      $table->string('update_progress')->nullable();
      $table->boolean('published');

      $table->timestamps();

      $table->float('rate')->default(5);
      $table->integer('reviews_count')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('stores');
  }
};

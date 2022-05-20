<?php

use App\Models\ContactType;
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
    Schema::create('merchant_contacts', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignIdFor(Merchant::class);
      $table->foreignIdFor(ContactType::class);
      $table->string('value', 150);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('merchant_contacts');
  }
};

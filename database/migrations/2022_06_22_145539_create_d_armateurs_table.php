<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDArmateursTable extends Migration
{
  public function up()
  {
    Schema::create('d_armateurs', function (Blueprint $table) {
      $table->id();
      $table->string('identite');
      $table->string('nom');
      $table->string('prenom');
      $table->string('email');
      $table->string('type');
      $table->string('nom_court');

      $table->integer('count')->nullable()->default(0);

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('d_armateurs');
  }
}

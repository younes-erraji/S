<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Armateurs extends Migration
{
  public function up()
  {
    Schema::create('armateurs', function (Blueprint $table) {
      $table->id();
      $table->string('identite');
      $table->string('nom');
      $table->string('prenom');
      $table->string('type');
      $table->string('nom_court');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('armateurs');
  }
}

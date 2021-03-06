<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Navires extends Migration
{
  public function up()
  {
    Schema::create('navires', function (Blueprint $table) {
      $table->id();
      $table->string('matricule')->unique();
      $table->string('nom');
      $table->string('portattache');
      $table->string('categorie');
      $table->string('scategorie');
      $table->string('type');
      $table->string('type_dem');
      $table->date('date_immatriculation');
      $table->string('quartier_maritime');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('navires');
  }
}

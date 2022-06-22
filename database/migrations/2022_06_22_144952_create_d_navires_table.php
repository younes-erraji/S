<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDNaviresTable extends Migration
{
  public function up()
  {
    Schema::create('d_navires', function (Blueprint $table) {
      $table->id();

      $table->string('matricule');
      $table->string('nom');
      $table->string('portattache');
      $table->string('categorie');
      $table->string('scategorie');
      $table->string('type');
      $table->string('type_dem');
      $table->date('date_immatriculation');
      $table->string('quartier_maritime');

      $table->string('armateur_id')->nullable();
      $table->string('armateur')->nullable();

      $table->integer('count')->nullable()->default(0);

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('d_navires');
  }
}

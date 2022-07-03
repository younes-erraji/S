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

      $table->foreign('matricule')->references('matricule')->on('navires')->onDelete('cascade')->onUpdate('cascade');

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

      $table->integer('count')->nullable()->default(1);

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('d_navires');
  }
}

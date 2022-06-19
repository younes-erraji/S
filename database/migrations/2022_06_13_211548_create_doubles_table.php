<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoublesTable extends Migration
{
  public function up()
  {
    Schema::create('doubles', function (Blueprint $table) {
      $table->id();

      $table->string('table')->nullable();

      $table->string('matricule')->nullable();
      $table->string('nom')->nullable();
      $table->string('portattache')->nullable();
      $table->string('categorie')->nullable();
      $table->string('scategorie')->nullable();

      $table->string('type')->nullable();

      $table->string('type_dem')->nullable();
      $table->date('date_immatriculation')->nullable();
      $table->string('quartier_maritime')->nullable();
      $table->bigInteger('armateur_id')->nullable();

      $table->string('intitule')->nullable();

      $table->integer('count')->nullable()->default(0);

      $table->date('operation_date')->nullable();

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('doubles');
  }
}

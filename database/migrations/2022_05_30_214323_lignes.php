<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lignes extends Migration
{
  public function up()
  {
    Schema::create('lignes', function (Blueprint $table) {
      $table->id();
      $table->string('intitule');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('lignes');
  }
}

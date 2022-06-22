<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NaviresArmateurs extends Migration
{
  public function up()
  {
    Schema::create('navires_armateurs', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('navire_id');
      $table->unsignedBigInteger('armateur_id');

      $table->foreign('navire_id')->references('id')->on('navires')->onDelete('cascade')->onUpdate('cascade');

      $table->foreign('armateur_id')->references('id')->on('armateurs')->onDelete('cascade')->onUpdate('cascade');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('navires_armateurs');
  }
}

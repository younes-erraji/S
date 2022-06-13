<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Operations extends Migration
{
  public function up()
  {
    Schema::create('operations', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->date('operation_date');
      $table->unsignedBigInteger('navire_id')->nullable();

      $table->foreign('navire_id')->references('id')->on('navires')->onDelete('cascade')->onUpdate('cascade');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('operations');
  }
}

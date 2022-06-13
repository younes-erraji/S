<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class History extends Migration
{
  public function up()
  {
    Schema::create('histories', function (Blueprint $table) {
      $table->id();
      $table->string('user');
      $table->string('role');
      $table->string('table');
      $table->string('operation');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('histories');
  }
}

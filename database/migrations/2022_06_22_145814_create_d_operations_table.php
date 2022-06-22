<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDOperationsTable extends Migration
{
  public function up()
  {
    Schema::create('d_operations', function (Blueprint $table) {
      $table->id();
      $table->string('type');
      $table->date('operation_date');
      $table->string('navire');

      $table->integer('count')->nullable()->default(0);

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('d_operations');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DOperations extends Model
{
  use HasFactory;
  protected $table = 'd_operations';
  protected $fillable = [
    'type', 'operation_date', 'navire', 'count'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getDOperations()
  {
    $operations = DOperations::all()->sortByDesc('created_at')->toArray();
    return $operations;
  }
}

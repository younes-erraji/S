<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
  use HasFactory;
  protected $table = 'operations';
  protected $fillable = [
    'type', 'operation_date', 'navire_id'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getOperations()
  {
    $operations = Operation::all()->sortByDesc('created_at')->toArray();
    return $operations;
  }

  public function Navire()
  {
    return $this->belongsTo(Navire::class);
  }
}

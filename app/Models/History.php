<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
  use HasFactory;
  protected $table = 'histories';
  protected $fillable = [
    'user', 'role', 'table', 'operation'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getHistories()
  {
    $histories = History::all()->sortByDesc('created_at')->toArray();
    return $histories;
  }
}

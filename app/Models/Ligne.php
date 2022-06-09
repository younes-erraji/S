<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligne extends Model
{
  use HasFactory;
  protected $table = 'lignes';
  protected $fillable = [
    'intitule'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getLignes()
  {
    $lignes = Ligne::all()->sortByDesc('created_at')->toArray();
    return $lignes;
  }
}

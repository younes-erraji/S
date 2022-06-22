<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DArmateurs extends Model
{
  use HasFactory;
  protected $table = 'd_armateurs';
  protected $fillable = [
    'identite', 'nom', 'prenom', 'email', 'type', 'nom_court', 'count'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getDArmateurs()
  {
    $armateurs = DArmateurs::all()->sortByDesc('created_at')->toArray();
    return $armateurs;
  }

  public function navires()
  {
    return $this->hasMany(Navire::class);
  }
}

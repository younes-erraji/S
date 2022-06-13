<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armateur extends Model
{
  use HasFactory;
  protected $table = 'armateurs';
  protected $fillable = [
    'identite', 'nom', 'prenom', 'email', 'type', 'nom_court'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getArmateurs()
  {
    $armateurs = Armateur::all()->sortByDesc('created_at')->toArray();
    return $armateurs;
  }

  public function navires()
  {
    return $this->hasMany(Navire::class);
  }
}

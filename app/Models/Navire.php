<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navire extends Model
{
  use HasFactory;
  protected $table = 'navires';
  protected $fillable = [
    'matricule', 'nom', 'portattache',
    'categorie', 'scategorie', 'type', 'type_dem', 'date_immatriculation', 'quartier_maritime'
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getNavires()
  {
    $navires = Navire::all()->sortByDesc('created_at')->toArray();
    return $navires;
  }

  public function Armateurs()
  {
    return $this->belongsToMany(Armateur::class, 'navires_armateurs');
  }
}

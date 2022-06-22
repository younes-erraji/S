<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DNavires extends Model
{
  use HasFactory;
  protected $table = 'd_navires';
  protected $fillable = [
    'matricule', 'nom', 'portattache',
    'categorie', 'scategorie', 'type', 'type_dem', 'date_immatriculation', 'quartier_maritime', 'armateur_id', 'armateur', 'count'
  ];

  protected $hidden = [
    'updated_at', 'armateur_id'
  ];

  public static function getDNavires()
  {
    $navires = DNavires::all()->sortByDesc('created_at')->toArray();
    return $navires;
  }
}

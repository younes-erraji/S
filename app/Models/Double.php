<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Double extends Model
{
  use HasFactory;
  protected $table = 'doubles';
  protected $fillable = [
    'matricule', 'nom', 'portattache', 'categorie',
    'scategorie', 'type', 'type_dem',
    'date_immatriculation', 'quartier_maritime', 'armateur_id',
    'intitule', 'operation_date',
  ];

  protected $hidden = [
    'updated_at'
  ];

  public static function getDoubles()
  {
    $doubles = Double::all()->sortByDesc('created_at')->toArray();
    return $doubles;
  }
}

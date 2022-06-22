<?php

namespace App\Imports;

use App\Models\DNavires;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DNaviresImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new DNavires([
      'matricule' => $row['matricule'],
      'nom' => $row['nom'],
      'portattache' => $row['portattache'],
      'categorie' => $row['categorie'],
      'scategorie' => $row['scategorie'],
      'type' => $row['type'],
      'type_dem' => $row['type_dem'],
      'date_immatriculation' => $row['date_immatriculation'],
      'quartier_maritime' => $row['quartier_maritime'],
      'armateur' => $row['armateur'],
      'count' => $row['count']
    ]);
  }
}

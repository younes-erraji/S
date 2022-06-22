<?php

namespace App\Imports;

use App\Models\Navire;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NaviresImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new Navire([
      'matricule' => $row['matricule'],
      'nom' => $row['nom'],
      'portattache' => $row['portattache'],
      'categorie' => $row['categorie'],
      'scategorie' => $row['scategorie'],
      'type' => $row['type'],
      'type_dem' => $row['type_dem'],
      'date_immatriculation' => $row['date_immatriculation'],
      'quartier_maritime' => $row['quartier_maritime'],
    ]);
  }
}

<?php

namespace App\Imports;

use App\Models\Double;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DoublesImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new Double([
      'table' => $row['table'],
      'matricule' => $row['matricule'],
      'nom' => $row['nom'],
      'portattache' => $row['portattache'],
      'categorie' => $row['categorie'],
      'scategorie' => $row['scategorie'],
      'type' => $row['type'],
      'type_dem' => $row['type_dem'],
      'date_immatriculation' => $row['date_immatriculation'],
      'quartier_maritime' => $row['quartier_maritime'],

      'armateur_id' => $row['armateur'],
      'operation_date' => $row['operation_date'],

      'intitule' => $row['intitule'],

      'count' => $row['count'],
    ]);
  }
}

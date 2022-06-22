<?php

namespace App\Imports;

use App\Models\DArmateurs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DArmateursImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new DArmateurs([
      'identite' => $row['identite'],
      'nom' => $row['nom'],
      'prenom' => $row['prenom'],
      'email' => $row['email'],
      'type' => $row['type'],
      'nom_court' => $row['nom_court'],
      'count' => $row['count'],
    ]);
  }
}

<?php

namespace App\Imports;

use App\Models\{Armateur, DArmateurs};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArmateursImport implements ToModel, WithHeadingRow
{

  public function model(array $row)
  {

    $armateur = Armateur::where('identite', '=', $row['identite'])->first();

    if (isset($armateur)) {
      DArmateurs::create([
        'identite' => $row['identite'],
        'nom' => $row['nom'],
        'prenom' => $row['prenom'],
        'email' => $row['email'],
        'type' => $row['type'],
        'nom_court' => $row['nom_court'],
      ]);
    } else {
      return new Armateur([
        'identite' => $row['identite'],
        'nom' => $row['nom'],
        'prenom' => $row['prenom'],
        'email' => $row['email'],
        'type' => $row['type'],
        'nom_court' => $row['nom_court'],
      ]);
    }
  }
}

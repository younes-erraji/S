<?php

namespace App\Exports;

use App\Models\Armateur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArmateursExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Identite', 'Nom', 'Prenom', 'E-mail', 'Type', 'Nom court', 'Armateur ID', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(Armateur::getArmateurs());
  }
}

<?php

namespace App\Exports;

use App\Models\Armateur;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArmateursExport implements FromCollection
{
  public function headings(): array
  {
    return [
      '#', 'identite', 'nom', 'prenom', 'type', 'nom_court', 'created_at'
    ];
  }

  public function collection()
  {
    return collect(Armateur::getArmateurs());
  }
}

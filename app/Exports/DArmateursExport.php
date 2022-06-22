<?php

namespace App\Exports;

use App\Models\DArmateurs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DArmateursExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Identite', 'Nom', 'Prenom', 'E-mail', 'Type', 'Nom court', 'Count', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(DArmateurs::getDArmateurs());
  }
}

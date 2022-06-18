<?php

namespace App\Exports;

use App\Models\Ligne;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LignesExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Intitule', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(Ligne::getLignes());
  }
}

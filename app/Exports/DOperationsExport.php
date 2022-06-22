<?php

namespace App\Exports;

use App\Models\DOperations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DOperationsExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Type', 'Date d\'opération', 'Navire', 'Count', "Créé à"
    ];
  }

  public function collection()
  {
    return collect(DOperations::getDOperations());
  }
}

<?php

namespace App\Exports;

use App\Models\Operation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperationExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Type', 'Date d\'opération', 'Navire', "Créé à"
    ];
  }

  public function collection()
  {
    return collect(Operation::getOperations());
  }
}

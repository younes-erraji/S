<?php

namespace App\Exports;

use App\Models\Operation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperationExport implements FromCollection
{
  public function headings(): array
  {
    return [
      '#', 'Type', 'operation_date'
    ];
  }

  public function collection()
  {
    return collect(Operation::getOperations());
  }
}

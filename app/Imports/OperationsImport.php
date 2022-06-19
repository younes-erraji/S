<?php

namespace App\Imports;

use App\Models\Operation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OperationsImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new Operation([
      'type' => $row['type'],
      'operation_date' => $row['operation_date'],
      'navire_id' => $row['navire'],
    ]);
  }
}

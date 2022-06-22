<?php

namespace App\Imports;

use App\Models\DOperations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DOperationsImport implements ToModel, WithHeadingRow
{
  public function model(array $row)
  {
    return new DOperations([
      'type' => $row['type'],
      'operation_date' => $row['operation_date'],
      'navire' => $row['navire'],
      'count' => $row['count']
    ]);
  }
}

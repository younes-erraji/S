<?php

namespace App\Exports;

use App\Models\Double;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoublesExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(Double::getDoubles());
  }
}

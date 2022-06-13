<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoriesExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'User', 'Role', 'Table', 'Operation', 'Operation Date'
    ];
  }

  public function collection()
  {
    return collect(History::getHistories());
  }
}

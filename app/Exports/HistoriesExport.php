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
      '#', 'Utilisateur', 'Rôle', 'Table', 'Opération', 'Date d\'opération'
    ];
  }

  public function collection()
  {
    return collect(History::getHistories());
  }
}

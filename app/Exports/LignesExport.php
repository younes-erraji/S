<?php

namespace App\Exports;

use App\Models\Ligne;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LignesExport implements FromCollection
{
  public function headings(): array
  {
    return [
      '#', 'intitule', 'created_at'
    ];
  }

  public function collection()
  {
    // return Category::all();
    return collect(Ligne::getLignes());
  }
}

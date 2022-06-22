<?php

namespace App\Exports;

use App\Models\DNavires;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DNaviresExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Matricule', 'Nom', 'Portattache',
      'Categorie', 'SCategorie', 'Type', 'Type Dem', 'Date Immatriculation', 'Quartier Maritime', 'Armateur', 'Count', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(DNavires::getDNavires());
  }
}

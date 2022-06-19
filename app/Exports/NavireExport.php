<?php

namespace App\Exports;

use App\Models\Navire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NavireExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Matricule', 'Nom', 'Portattache',
      'Categorie', 'SCategorie', 'Type', 'Type Dem', 'Date Immatriculation', 'Quartier Maritime', 'Armateur', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(Navire::getNavires());
  }
}

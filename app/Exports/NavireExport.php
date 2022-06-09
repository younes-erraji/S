<?php

namespace App\Exports;

use App\Models\Navire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NavireExport implements FromCollection
{
  public function headings(): array
  {
    return [
      '#', 'matricule', 'nom', 'email', 'portattache',
      'categorie', 'scategorie', 'type', 'type_dem', 'date_immatriculation', 'quartier_maritime', 'Created at'
    ];
  }

  public function collection()
  {
    return collect(Navire::getNavires());
  }
}

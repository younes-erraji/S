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
      '#', 'Table', 'Matricule', 'Nom', 'Portattache', 'Categorie', 'SCategorie', 'Type', 'Type_dem', 'Date_immatriculation', 'Quartier_maritime', 'Armateur', 'Intitule', 'Count', 'Operation_date', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(Double::getDoubles());
  }
}

<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
  public function headings(): array
  {
    return [
      '#', 'Name', 'Adresse e-mail', 'E-mail vérifié à', 'Créé à'
    ];
  }

  public function collection()
  {
    return collect(User::getUsers());
  }
}

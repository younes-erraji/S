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
      '#', 'Name', 'E-mail Address', 'E-mail Verified at', 'Created at', 'Updated at'
    ];
  }

  public function collection()
  {
    return collect(User::getUsers());
  }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
  public function run()
  {
    $superadministrator = User::create([
      'name' => 'Superadministrator',
      'email' => 'superadministrator@admin.com',
      'password' => Hash::make('123456'),
    ]);
    $superadministrator->attachRole('superadministrator');

    $administrator = User::create([
      'name' => 'Administrator',
      'email' => 'administrator@admin.com',
      'password' => Hash::make('123456'),
    ]);
    $administrator->attachRole('administrator');

    $user = User::create([
      'name' => 'User',
      'email' => 'user@mail.com',
      'password' => Hash::make('123456'),
    ]);
    $user->attachRole('user');

    $soumaya = User::create([
      'name' => 'Soumaya',
      'email' => 'soumaya@mail.com',
      'password' => Hash::make('123456'),
    ]);
    $soumaya->attachRole('superadministrator');
  }
}

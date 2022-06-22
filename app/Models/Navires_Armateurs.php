<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Navires_Armateurs extends Model
{
  use HasFactory;
  protected $table = 'navires_armateurs';
  protected $fillable = [
    'navire_id', 'armateur_id'
  ];

  protected $hidden = [
    'updated_at'
  ];
}

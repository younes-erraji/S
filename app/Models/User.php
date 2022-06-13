<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use DB;

class User extends Authenticatable
{
  use LaratrustUserTrait;
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  protected $hidden = [
    'password',
    'remember_token',
    'updated_at'
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function role()
  {
    $role_id = DB::table('role_user')->where('user_id', '=', $this->id)->get()[0]->role_id;
    return DB::table('roles')->where('id', '=', $role_id)->get()[0];
  }

  public static function getUsers()
  {
    $users = User::all()->sortByDesc('created_at')->toArray();
    return $users;
  }
}

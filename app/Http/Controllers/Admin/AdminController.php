<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:user|administrator|superadministrator');
  }
  public function index()
  {
    return view('board.admin');
  }
}

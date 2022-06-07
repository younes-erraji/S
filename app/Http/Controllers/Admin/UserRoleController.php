<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Exports\UserExport;
use Export;

class UserRoleController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:superadministrator')->except(['show', 'excel', 'csv']);
  }

  public function index() {
    $users = User::all()->sortByDesc('created_at');
    return view('board.users.index', ['users' => $users]);
  }

  public function edit(User $user) {
    return view('board.users.edit', ['user' => $user]);
  }

  public function update(User $user) {
    if (!$user->hasRole('superadministrator')) {
      Request()->validate([
        'user_role' => 'required',
      ], [
        'user_role.required' => 'The user role field is required',
      ]);

      if (request('user_role') === 'user' || request('user_role') === 'administrator') {
        $test = DB::update('delete from role_user where user_id = ?', [$user->id]);
        $user->attachRole(request('user_role'));
        if ($test) {
          return back()->with('success', 'The UPDATE Operation completed successfully');
        } else {
          return back()->with('fail', 'Something went wrong');
        }
      }
    } else {
      return back()->with('fail', 'You cannot change the main admin role');
    }
  }
  public function show(User $user) {
    return view('board.users.show', ['user' => $user]);
  }

  public function excel() {
    return Export::download(new UserExport, 'users.xlsx');
  }
  public function csv() {
    return Export::download(new UserExport, 'users.csv');
  }
}

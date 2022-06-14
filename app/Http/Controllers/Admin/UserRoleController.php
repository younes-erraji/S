<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, History};
use Illuminate\Support\Facades\{DB, Hash};
use App\Exports\UserExport;
use Excel;

class UserRoleController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:administrator|superadministrator')->except(['show', 'excel', 'csv']);
  }

  public function index()
  {
    $users = User::all()->sortByDesc('created_at');
    return view('board.users.index', ['users' => $users]);
  }

  public function edit(User $user)
  {
    return view('board.users.edit', ['user' => $user]);
  }

  public function update(User $user)
  {
    Request()->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'password' => 'required|string|min:8|confirmed',
      'user_role' => 'required',
    ]);

    if (request('user_role') === 'user' || request('user_role') === 'administrator') {
      $test = DB::update('delete from role_user where user_id = ?', [$user->id]);
      $user->attachRole(request('user_role'));
      if ($test) {
        $user->update([
          'name' => request('name'),
          'email' => request('email'),
          'password' => Hash::make(request('password')),
        ]);

        History::create([
          'user' => auth()->user()->name,
          'role' => auth()->user()->role()->display_name,
          'table' => 'Users',
          'operation' => 'Update'
        ]);
        return back()->with('success', 'The UPDATE Operation completed successfully');
      } else {
        return back()->with('fail', 'Something went wrong');
      }
    }
  }
  public function show(User $user)
  {
    return view('board.users.show', ['user' => $user]);
  }

  public function create()
  {
    return view('board.users.create');
  }

  public function store()
  {
    Request()->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
      'user_role' => 'required',
    ]);

    $test = User::create([
      'name' => request('name'),
      'email' => request('email'),
      'password' => Hash::make(request('password')),
    ]);

    if ($test) {
      $test->attachRole(request('user_role'));
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Users',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'The INSERTION Completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function destroy(User $user)
  {
    $test = DB::update('delete from role_user where user_id = ?', [$user->id]);

    if ($test) {
      $test = $user->delete();
      if ($test) {
        History::create([
          'user' => auth()->user()->name,
          'role' => auth()->user()->role()->display_name,
          'table' => 'Users',
          'operation' => 'Delete'
        ]);
        return redirect('/users')->with('success', 'The DELETE Operation completed successfully');
      } else {
        return back()->with('fail', 'Something went wrong');
      }
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function excel()
  {
    return Excel::download(new UserExport, 'users.xlsx');
  }
  public function csv()
  {
    return Excel::download(new UserExport, 'users.csv');
  }
}

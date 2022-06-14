<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Armateur, History};
use App\Exports\ArmateursExport;
use Excel;

class ArmateursController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:user|administrator|superadministrator');
  }

  public function index()
  {
    $armateurs = Armateur::all();
    return view('board.armateurs.index', ['armateurs' => $armateurs]);
  }

  public function edit(Armateur $armateur)
  {
    return view('board.armateurs.edit', ['armateur' => $armateur]);
  }

  public function create()
  {
    return view('board.armateurs.create');
  }

  public function update(Armateur $armateur)
  {
    request()->validate([
      'identite' => 'required',
      'nom' => 'required',
      'prenom' => 'required',
      'type' => 'required',
      'nom_court' => 'required'
    ]);

    $test = $armateur->update([
      'identite' => request('identite'),
      'nom' => request('nom'),
      'prenom' => request('prenom'),
      'type' => request('type'),
      'nom_court' => request('nom_court'),
    ]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Armateurs',
        'operation' => 'Update'
      ]);

      return back()->with('success', 'The UPDATE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function store()
  {
    request()->validate([
      'identite' => 'required',
      'nom' => 'required',
      'prenom' => 'required',
      'email' => 'required|email',
      'type' => 'required',
      'nom_court' => 'required'
    ]);

    $test = Armateur::create([
      'identite' => request('identite'),
      'nom' => request('nom'),
      'prenom' => request('prenom'),
      'email' => request('email'),
      'type' => request('type'),
      'nom_court' => request('nom_court'),
    ]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Armateurs',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'The INSERTION Completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function destroy(Armateur $armateur)
  {
    $test = $armateur->delete();

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Armateurs',
        'operation' => 'Delete'
      ]);

      return redirect('/armateurs')->with('success', 'The DELETE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function excel()
  {
    return Excel::download(new ArmateursExport, 'armateurs.xlsx');
  }
  public function csv()
  {
    return Excel::download(new ArmateursExport, 'armateurs.csv');
  }
}

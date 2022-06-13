<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ligne;
use App\Models\History;
use App\Exports\LignesExport;
use Excel;

class LignesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:user|administrator|superadministrator');
  }

  public function index()
  {
    $lignes = Ligne::all();
    return view('board.lignes.index', ['lignes' => $lignes]);
  }

  public function edit(Ligne $ligne)
  {
    return view('board.lignes.edit', ['ligne' => $ligne]);
  }

  public function create()
  {
    return view('board.lignes.create');
  }

  public function update(Ligne $ligne)
  {
    request()->validate([
      'intitule' => 'required|max:255',
    ]);

    $test = $ligne->update([
      'intitule' => request('intitule'),
    ]);

    if ($test) {

      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Lignes',
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
      'intitule' => 'required|max:255',
    ]);

    $test = Ligne::create([
      'intitule' => request('intitule'),
    ]);

    if ($test) {

      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Lignes',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'The INSERTION Completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function destroy(Ligne $ligne)
  {
    $test = $ligne->delete();

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Lignes',
        'operation' => 'Delete'
      ]);

      return redirect('/lignes')->with('success', 'The DELETE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function excel()
  {
    return Excel::download(new LignesExport, 'lignes.xlsx');
  }
  public function csv()
  {
    return Excel::download(new LignesExport, 'lignes.csv');
  }
}

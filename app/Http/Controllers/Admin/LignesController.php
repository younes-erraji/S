<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Ligne, History, Double};
use App\Exports\LignesExport;
use Excel;
use Illuminate\Support\Facades\DB;

class LignesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
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

      return back()->with('success', 'L\'opération UPDATE s`\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function store()
  {
    request()->validate([
      'intitule' => 'required|max:255',
    ]);

    $count = DB::table('lignes')->where('intitule', '=', request('intitule'))->count();

    $test = null;
    if ($count != 0) {
      // $test = Double::create([
      //   'table' => 'Ligne',
      //   'intitule' => request('intitule'),
      // ]);
    } else {
      $test = Ligne::create([
        'intitule' => request('intitule'),
      ]);
    }

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Lignes',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'L\'INSERTION terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
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

      return redirect('/lignes')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
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

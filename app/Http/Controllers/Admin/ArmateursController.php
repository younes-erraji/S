<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Armateur, DArmateurs, History, Navire};
use App\Exports\ArmateursExport;
use App\Imports\ArmateursImport;
use Excel;
use Illuminate\Support\Facades\DB;

class ArmateursController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
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
      'email' => request('email'),
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

      return back()->with('success', 'L\'opération UPDATE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
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

    $count = DB::table('armateurs')->where('identite', '=', request('identite'))->count();

    $test = null;
    if ($count != 0) {
      $double = DArmateurs::where('identite', '=', request('identite'))->first();

      if ($double) {
        $test = $double->update([
          'count' => $double->count + 1
        ]);
      } else {
        $test = DArmateurs::create([
          'identite' => request('identite'),
          'nom' => request('nom'),
          'prenom' => request('prenom'),
          'email' => request('email'),
          'type' => request('type'),
          'nom_court' => request('nom_court'),
          'count' => 1
        ]);
      }
    } else {
      $test = Armateur::create([
        'identite' => request('identite'),
        'nom' => request('nom'),
        'prenom' => request('prenom'),
        'email' => request('email'),
        'type' => request('type'),
        'nom_court' => request('nom_court'),
      ]);
    }

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Armateurs',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'L\'INSERTION terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function destroy(Armateur $armateur)
  {
    $test = DB::delete('delete from d_armateurs where identite = ?', [$armateur->identite]);
    $test = $armateur->delete();

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Armateurs',
        'operation' => 'Delete'
      ]);

      return redirect('/armateurs')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
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

  public function show(Armateur $armateur)
  {
    $navires = Armateur::join('navires_armateurs', 'navires_armateurs.armateur_id', 'armateurs.id')->join('navires', 'navires.id', 'navires_armateurs.navire_id')
      ->where('armateurs.id', '=', $armateur->id)->get();

    return view("board.armateurs.show", ['armateur' => $armateur, 'navires' => $navires]);
  }

  public function import()
  {
    request()->validate([
      'excel-armateurs' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new ArmateursImport, request('excel-armateurs'));

    return back()->with('success', 'Importé avec succés');
  }
}

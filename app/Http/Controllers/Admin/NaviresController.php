<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Navire, Armateur, History, Double};
use App\Exports\NavireExport;
use App\Imports\NaviresImport;
use Excel;
use Illuminate\Support\Facades\DB;

class NaviresController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $navires = Navire::all();
    return view('board.navires.index', ['navires' => $navires]);
  }

  public function edit(Navire $navire)
  {
    $armateurs = Armateur::all();
    return view('board.navires.edit', ['navire' => $navire, 'armateurs' => $armateurs]);
  }

  public function update(Navire $navire)
  {
    request()->validate([
      'matricule' => 'required',
      'nom' => 'required',
      'portattache' => 'required',
      'categorie' => 'required',
      'scategorie' => 'required',
      'type' => 'required',
      'type_dem' => 'required',
      'date_immatriculation' => 'required|date',
      'quartier_maritime' => 'required',

      'armateur_id' => 'required'
    ]);

    $test = $navire->update([
      'matricule' => request('matricule'),
      'nom' => request('nom'),

      'portattache' => request('portattache'),
      'categorie' => request('categorie'),
      'scategorie' => request('scategorie'),
      'type' => request('type'),
      'type_dem' => request('type_dem'),
      'date_immatriculation' => request('date_immatriculation'),
      'quartier_maritime' => request('quartier_maritime'),

      'armateur_id' => request('armateur_id')
    ]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Navires',
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
      'matricule' => 'required',
      'nom' => 'required',

      'portattache' => 'required',
      'categorie' => 'required',
      'scategorie' => 'required',
      'type' => 'required',
      'type_dem' => 'required',
      'date_immatriculation' => 'required|date',
      'quartier_maritime' => 'required',

      'armateur_id' => 'required'
    ]);

    $count = DB::table('navires')->where('matricule', '=', request('matricule'))->count();

    $test = null;
    if ($count != 0) {

      $double = Double::where('matricule', '=', request('matricule'))->first();

      if ($double) {
        $test = $double->update([
          'count' => $double->count + 1
        ]);
      } else {
        $test = Double::create([
          'table' => 'Navire',
          'matricule' => request('matricule'),
          'nom' => request('nom'),
          'portattache' => request('portattache'),
          'categorie' => request('categorie'),
          'scategorie' => request('scategorie'),
          'type' => request('type'),
          'type_dem' => request('type_dem'),
          'date_immatriculation' => request('date_immatriculation'),
          'quartier_maritime' => request('quartier_maritime'),

          'armateur_id' => request('armateur_id'),
          'count' => 1
        ]);
      }
    } else {
      $test = Navire::create([
        'matricule' => request('matricule'),
        'nom' => request('nom'),
        'portattache' => request('portattache'),
        'categorie' => request('categorie'),
        'scategorie' => request('scategorie'),
        'type' => request('type'),
        'type_dem' => request('type_dem'),
        'date_immatriculation' => request('date_immatriculation'),
        'quartier_maritime' => request('quartier_maritime'),

        'armateur_id' => request('armateur_id')
      ]);
    }

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Navires',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'L\'INSERTION terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function destroy(Navire $navire)
  {
    $test = $navire->delete();

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Navires',
        'operation' => 'Delete'
      ]);

      return redirect('/navires')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function excel()
  {
    return Excel::download(new NavireExport, 'navires.xlsx');
  }
  public function csv()
  {
    return Excel::download(new NavireExport, 'navires.csv');
  }

  public function show(Navire $navire)
  {
    return view("board.navires.show", ['navire' => $navire]);
  }

  public function create()
  {
    $armateurs = Armateur::all();
    return view('board.navires.create', ['armateurs' => $armateurs]);
  }

  public function import()
  {
    request()->validate([
      'excel-navires' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new NaviresImport, request('excel-navires'));

    return back()->with('success', 'Importé avec succés');
  }
}

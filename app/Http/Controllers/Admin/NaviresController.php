<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Navire, Armateur, DNavires, History};
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

      $count = DNavires::where('matricule', '=', request('matricule'))->count();

      $armateur = Armateur::where('id', '=', request('armateur_id'))->first();

      $test = DNavires::create([
        'matricule' => request('matricule'),
        'nom' => request('nom'),
        'portattache' => request('portattache'),
        'categorie' => request('categorie'),
        'scategorie' => request('scategorie'),
        'type' => request('type'),
        'type_dem' => request('type_dem'),
        'date_immatriculation' => request('date_immatriculation'),
        'quartier_maritime' => request('quartier_maritime'),
        'armateur_id' => $armateur->identite,
        'armateur' => $armateur->nom . ' ' . $armateur->prenom,
        'count' => $count + 1
      ]);
    } else {
      $navire = new Navire();

      $navire->matricule = request('matricule');
      $navire->nom = request('nom');
      $navire->portattache = request('portattache');
      $navire->categorie = request('categorie');
      $navire->scategorie = request('scategorie');
      $navire->type = request('type');
      $navire->type_dem = request('type_dem');
      $navire->date_immatriculation = request('date_immatriculation');
      $navire->quartier_maritime = request('quartier_maritime');

      $test = $navire->save();

      DB::table('navires_armateurs')->insert([
        'navire_id' => $navire->id,
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
    $armateurs = Navire::join('navires_armateurs', 'navires_armateurs.navire_id', 'navires.id')->join('armateurs', 'armateurs.id', 'navires_armateurs.armateur_id')
      ->where('navires.id', '=', $navire->id)->get();

    return view("board.navires.show", ['navire' => $navire, 'armateurs' => $armateurs]);
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

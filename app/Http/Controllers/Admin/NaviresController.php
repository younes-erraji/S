<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Navire, Armateur, History, Double};
use App\Exports\NavireExport;
use Excel;
use Illuminate\Support\Facades\DB;

class NaviresController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:user|administrator|superadministrator');
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

  public function create()
  {
    $armateurs = Armateur::all();
    return view('board.navires.create', ['armateurs' => $armateurs]);
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
      'quartier_maritime' => 'required|date',

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

      return back()->with('success', 'The UPDATE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
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
      $test = Double::create([
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

      return back()->with('success', 'The INSERTION Completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
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

      return redirect('/navires')->with('success', 'The DELETE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
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
}

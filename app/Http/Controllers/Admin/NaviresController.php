<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Navire;
use App\Exports\NavireExport;
use Excel;

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
    return view('board.navires.edit', ['navire' => $navire]);
  }

  public function create()
  {
    return view('board.navires.create');
  }

  public function update(Navire $navire)
  {
    request()->validate([
      'matricule' => 'required|min:7',
      'nom' => 'required|min:7',
      'email' => 'required|email|min:7',
      'portattache' => 'required|min:7',
      'categorie' => 'required|min:7',
      'scategorie' => 'required|min:7',
      'type' => 'required|min:7',
      'type_dem' => 'required|min:7',
      'date_immatriculation' => 'required|date',
      'quartier_maritime' => 'required|date',
    ]);

    $test = $navire->update([
      'matricule' => request('matricule'),
      'nom' => request('nom'),
      'email' => request('email'),
      'portattache' => request('portattache'),
      'categorie' => request('categorie'),
      'scategorie' => request('scategorie'),
      'type' => request('type'),
      'type_dem' => request('type_dem'),
      'date_immatriculation' => request('date_immatriculation'),
      'quartier_maritime' => request('quartier_maritime'),
    ]);

    if ($test) {
      return back()->with('success', 'The UPDATE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function store()
  {
    request()->validate([
      'matricule' => 'required|min:7',
      'nom' => 'required|min:7',
      'email' => 'required|email|min:7',
      'portattache' => 'required|min:7',
      'categorie' => 'required|min:7',
      'scategorie' => 'required|min:7',
      'type' => 'required|min:7',
      'type_dem' => 'required|min:7',
      'date_immatriculation' => 'required|date',
      'quartier_maritime' => 'required|date',
    ]);

    $test = Navire::create([
      'matricule' => request('matricule'),
      'nom' => request('nom'),
      'email' => request('email'),
      'portattache' => request('portattache'),
      'categorie' => request('categorie'),
      'scategorie' => request('scategorie'),
      'type' => request('type'),
      'type_dem' => request('type_dem'),
      'date_immatriculation' => request('date_immatriculation'),
      'quartier_maritime' => request('quartier_maritime'),
    ]);

    if ($test) {
      return back()->with('success', 'The INSERTION Completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function destroy(Navire $navire)
  {
    $test = $navire->delete();

    if ($test) {
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

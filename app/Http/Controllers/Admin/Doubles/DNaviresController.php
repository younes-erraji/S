<?php

namespace App\Http\Controllers\Admin\Doubles;

use App\Http\Controllers\Controller;
use App\Exports\DNaviresExport;
use App\Imports\DNaviresImport;
use App\Models\{Armateur, DNavires, History, Navire};
use Excel;
use Illuminate\Support\Facades\DB;

class DNaviresController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $navires = Navire::all();
    $d_navires = DNavires::all();

    return view('board.doubles.navires.index', ['d_navires' => $d_navires, 'navires' => $navires]);
  }

  public function getNavireDoubles()
  {
    $d_navires = DB::table('d_navires')->where('matricule', request()->code)->get();
    if (count($d_navires) > 0) {
      return response()->json(['code' => 1, 'd_navires' => $d_navires]);
    } else {
      return response()->json(['code' => 0, 'message' => "There's no data to show"]);
    }
  }

  public function destroy($d_navire)
  {
    $test = DB::delete('delete from d_navires where id = ?', [$d_navire]);
    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Doubles des Navires',
        'operation' => 'Delete'
      ]);

      return redirect('/doubles/navires')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function fusionner($d_navire)
  {
    $navire = DNavires::find($d_navire);

    $main_navire = Navire::where('matricule', '=', $navire->matricule)->first();

    $armateur = Armateur::where('identite', '=', $navire->armateur_id)->first();

    $main_navire->update([
      'nom' => $navire->nom,
      'portattache' => $navire->portattache,
      'categorie' => $navire->categorie,
      'scategorie' => $navire->scategorie,
      'type' => $navire->type,
      'type_dem' => $navire->type_dem,
      'date_immatriculation' => $navire->date_immatriculation,
      'quartier_maritime' => $navire->quartier_maritime,
    ]);

    // DB::delete('delete from navires_armateurs where navire_id = ?, armateur_id = ?', [$main_navire->id, $armateur->id]);
    $test = DB::insert('insert into navires_armateurs (navire_id, armateur_id) values (?, ?)', [$main_navire->id, $armateur->id]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Doubles des Navires',
        'operation' => 'Fusionner'
      ]);

      return redirect('/doubles/navires')->with('success', 'L\'opération Fusionner s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function comparer($id)
  {
    $navire = DNavires::find($id);

    $main_navire = Navire::where('matricule', '=', $navire->matricule)->first();

    $armateurs = Navire::join('navires_armateurs', 'navires_armateurs.navire_id', 'navires.id')->join('armateurs', 'armateurs.id', 'navires_armateurs.armateur_id')
      ->where('navires.id', '=', $main_navire->id)->get();

    return view('board.doubles.navires.compare', ['d_navire' => $navire, 'navire' => $main_navire, 'armateurs' => $armateurs]);
  }

  public function export()
  {
    return Excel::download(new DNaviresExport, 'navires.xlsx');
  }

  public function show($d_navire)
  {
    $navire = DB::table('d_navires')->find($d_navire);

    return view('board.doubles.navires.show', ['d_navire' => $navire]);
  }

  public function import()
  {
    request()->validate([
      'navires' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new DNaviresImport, request('navires'));

    return back()->with('success', 'Importé avec succés');
  }
}

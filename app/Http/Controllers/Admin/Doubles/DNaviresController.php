<?php

namespace App\Http\Controllers\Admin\Doubles;

use App\Http\Controllers\Controller;
use App\Exports\DNaviresExport;
use App\Imports\DNaviresImport;
use App\Models\{Armateur, DNavires, History};
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
    $d_navires = DNavires::all();
    return view('board.doubles.navires.index', ['d_navires' => $d_navires]);
  }

  public function destroy($d_navire)
  {
    $navire = DNavires::find($d_navire);

    $armateur = Armateur::where('identite', '=', $navire->armateur_id)->first();

    DB::insert('insert into navires_armateurs (navire_id, armateur_id) values (?, ?)', [$navire->id, $armateur->id]);

    $test = DB::delete('delete from d_navires where id = ?', [$d_navire]);
    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Doubles',
        'operation' => 'Delete'
      ]);

      return redirect('/doubles/navires')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
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

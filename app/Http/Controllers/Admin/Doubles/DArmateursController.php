<?php

namespace App\Http\Controllers\Admin\Doubles;

use App\Exports\DArmateursExport;
use App\Http\Controllers\Controller;
use App\Imports\DArmateursImport;
use App\Models\DArmateurs;
use App\Models\History;
use App\Models\Navire;
use Excel;
use Illuminate\Support\Facades\DB;

class DArmateursController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $d_armateurs = DArmateurs::all();
    return view('board.doubles.armateurs.index', ['d_armateurs' => $d_armateurs]);
  }

  public function destroy($d_armateur)
  {
    $test = DB::delete('delete from d_armateurs where id = ?', [$d_armateur]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Doubles des Armateurs',
        'operation' => 'Delete'
      ]);

      return redirect('/doubles/armateurs')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function export()
  {
    return Excel::download(new DArmateursExport, 'armateurs.xlsx');
  }

  public function show($d_armateur)
  {
    $armateur = DB::table('d_armateurs')->find($d_armateur);
    return view('board.doubles.armateurs.show', ['d_armateur' => $armateur]);
  }

  public function import()
  {
    request()->validate([
      'armateurs' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new DArmateursImport, request('armateurs'));

    return back()->with('success', 'Importé avec succés');
  }
}

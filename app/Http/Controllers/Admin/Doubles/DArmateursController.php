<?php

namespace App\Http\Controllers\Admin\Doubles;

use App\Exports\DArmateursExport;
use App\Http\Controllers\Controller;
use App\Imports\DArmateursImport;
use App\Models\{Armateur, DArmateurs, History};
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
    $d_armateurs = DArmateurs::all()->sortByDesc('created_at');
    $armateurs = Armateur::all();
    return view('board.doubles.armateurs.index', ['d_armateurs' => $d_armateurs, 'armateurs' => $armateurs]);
  }

  public function getArmateurDoubles()
  {
    $d_armateurs = DB::table('d_armateurs')->where('identite', request()->code)->get();
    if (count($d_armateurs) > 0) {
      return response()->json(['code' => 1, 'd_armateurs' => $d_armateurs]);
    } else {
      return response()->json(['code' => 0, 'message' => "There's no data to show"]);
    }
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

  public function fusionner($d_armateur)
  {
    $armateur = DArmateurs::find($d_armateur);

    $main_armateur = Armateur::where('identite', '=', $armateur->identite)->first();

    $test = $main_armateur->update([
      'nom' => $armateur->nom,
      'prenom' => $armateur->prenom,
      'email' => $armateur->email,
      'type' => $armateur->type,
      'nom_court' => $armateur->nom_court,
    ]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Doubles des Navires',
        'operation' => 'Fusionner'
      ]);

      return redirect('/doubles/armateurs')->with('success', 'L\'opération Fusionner s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function comparer($id)
  {
    $armateur = DArmateurs::find($id);

    $main_armateur = Armateur::where('identite', '=', $armateur->identite)->first();

    return view('board.doubles.armateurs.compare', ['d_armateur' => $armateur, 'armateur' => $main_armateur]);
  }
}

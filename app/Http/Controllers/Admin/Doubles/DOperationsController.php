<?php

namespace App\Http\Controllers\Admin\Doubles;

use App\Exports\DOperationsExport;
use App\Http\Controllers\Controller;
use App\Imports\DOperationsImport;
use App\Models\{DOperations, History};
use Excel;
use DB;

class DOperationsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $d_operations = DOperations::all();
    return view('board.doubles.operations.index', ['d_operations' => $d_operations]);
  }

  public function destroy($d_operation)
  {
    $test = DB::delete('delete from d_operations where id = ?', [$d_operation]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Doublons des Operations',
        'operation' => 'Delete'
      ]);

      return redirect('/doubles/operations')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Quelque chose s\'est mal passé');
    }
  }

  public function export()
  {
    return Excel::download(new DOperationsExport, 'operations.xlsx');
  }

  public function import()
  {
    request()->validate([
      'operations' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new DOperationsImport, request('operations'));

    return back()->with('success', 'Importé avec succés');
  }
}

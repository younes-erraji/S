<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{DOperations, Operation, History, Navire};
use App\Exports\OperationExport;
use App\Imports\OperationsImport;
use Excel;
use Illuminate\Support\Facades\DB;

class OperationsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $operations = Operation::all()->sortByDesc('created_at');
    return view('board.operations.index', ['operations' => $operations]);
  }

  public function edit(Operation $operation)
  {
    $navires = Navire::all();
    return view('board.operations.edit', ['operation' => $operation, 'navires' => $navires]);
  }

  public function create()
  {
    $navires = Navire::all();
    return view('board.operations.create', ['navires' => $navires]);
  }

  public function update(Operation $operation)
  {
    request()->validate([
      'type' => 'required',
      'operation_date' => 'required|date',
      'navire_id' => 'required',
    ]);

    $test = $operation->update([
      'type' => request('type'),
      'operation_date' => request('operation_date'),
      'navire_id' => request('navire_id'),
    ]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Operations',
        'operation' => 'Update'
      ]);

      return back()->with('success', 'L\'opération UPDATE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function store()
  {
    request()->validate([
      'type' => 'required',
      'operation_date' => 'required|date',
      'navire_id' => 'required',
    ]);

    $test = Operation::create([
      'type' => request('type'),
      'operation_date' => request('operation_date'),
      'navire_id' => request('navire_id'),
    ]);

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Operations',
        'operation' => 'Insert'
      ]);

      return back()->with('success', 'L\'INSERTION terminée avec succès');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function destroy(Operation $operation)
  {
    $navire = Navire::where('id', '=', $operation->navire_id)->first();

    DB::delete('delete from d_operations where type = ? and navire = ?', [$operation->type, $navire->matricule]);
    $test = $operation->delete();

    if ($test) {
      History::create([
        'user' => auth()->user()->name,
        'role' => auth()->user()->role()->display_name,
        'table' => 'Operations',
        'operation' => 'Delete'
      ]);

      return redirect('/operations')->with('success', 'L\'opération DELETE s\'est terminée avec succès');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function excel()
  {
    return Excel::download(new OperationExport, 'operations.xlsx');
  }
  public function csv()
  {
    return Excel::download(new OperationExport, 'operations.csv');
  }

  public function import()
  {
    request()->validate([
      'excel-operations' => 'required|mimes:xlsx,csv',
    ]);

    Excel::import(new OperationsImport, request('excel-operations'));

    return back()->with('success', 'Importé avec succés');
  }
}

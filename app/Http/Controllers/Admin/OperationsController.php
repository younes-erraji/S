<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Operation, History, Double, Navire};
use App\Exports\OperationExport;
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
    $operations = Operation::all();
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

    $count = DB::table('operations')->where('type', '=', request('type'))->count();

    $test = null;
    if ($count != 0) {
      $test = Double::create([
        'table' => 'Operation',
        'type' => request('type'),
        'operation_date' => request('operation_date'),
      ]);
    } else {
      $test = Operation::create([
        'type' => request('type'),
        'operation_date' => request('operation_date'),
        'navire_id' => request('navire_id'),
      ]);
    }



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
    return 'Import';
  }
}

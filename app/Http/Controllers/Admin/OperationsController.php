<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operation;
use App\Models\History;
use App\Exports\OperationExport;
use App\Models\Navire;
use Excel;

class OperationsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:user|administrator|superadministrator');
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

      return back()->with('success', 'The UPDATE Operation completed successfully');
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

      return back()->with('success', 'The INSERTION Completed successfully');
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

      return redirect('/operations')->with('success', 'The DELETE Operation completed successfully');
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
}

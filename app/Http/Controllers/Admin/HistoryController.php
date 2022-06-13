<?php

namespace App\Http\Controllers\Admin;

use App\Exports\HistoriesExport;
use App\Http\Controllers\Controller;
use App\Models\History;
use Excel;

class HistoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('role:administrator|superadministrator');
  }

  public function index()
  {
    $histories = History::all();
    return view('board.histories.index', ['histories' => $histories]);
  }

  public function destroy(History $history)
  {
    $test = $history->delete();

    if ($test) {
      return redirect('/history')->with('success', 'The DELETE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function excel()
  {
    return Excel::download(new HistoriesExport, 'history.xlsx');
  }
  public function csv()
  {
    return Excel::download(new HistoriesExport, 'history.csv');
  }
}

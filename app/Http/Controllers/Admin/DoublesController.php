<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\DoublesExport;
use App\Models\Double;
use Excel;

class DoublesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $doubles = Double::all();
    return view('board.doubles.index', ['doubles' => $doubles]);
  }

  public function destroy(Double $double)
  {
    $test = $double->delete();

    if ($test) {
      return redirect('/doubles')->with('success', 'The DELETE Operation completed successfully');
    } else {
      return back()->with('fail', 'Something went wrong');
    }
  }

  public function excel()
  {
    return Excel::download(new DoublesExport, 'doubles.xlsx');
  }
  public function csv()
  {
    return Excel::download(new DoublesExport, 'doubles.csv');
  }
}

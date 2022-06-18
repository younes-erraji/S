<?php

use App\Http\Controllers\Admin\{
  ArmateursController,
  LignesController,
  NaviresController,
  OperationsController,
  AdminController,
  DoublesController,
  UserRoleController,
  HistoryController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
});

Auth::routes(['register' => false]);

Route::get('admin', [AdminController::class, 'index'])->name('admin');

Route::prefix('navires')->group(function () {
  Route::get('/', [NaviresController::class, 'index']);
  Route::get('{navire}/edit', [NaviresController::class, 'edit']);
  Route::get('{navire}', [NaviresController::class, 'show']);
  Route::put('{navire}', [NaviresController::class, 'update']);
  Route::get('create', [NaviresController::class, 'create'])->name('navire.create');
  Route::post('/', [NaviresController::class, 'store']);
  Route::delete('{navire}', [NaviresController::class, 'destroy']);
});

Route::prefix('operations')->group(function () {
  Route::get('/', [OperationsController::class, 'index']);
  Route::get('{operation}/edit', [OperationsController::class, 'edit']);
  Route::put('{operation}', [OperationsController::class, 'update']);
  Route::get('create', [OperationsController::class, 'create']);
  Route::post('/', [OperationsController::class, 'store']);
  Route::delete('{operation}', [OperationsController::class, 'destroy']);
});

Route::prefix('lignes')->group(function () {
  Route::get('/', [LignesController::class, 'index']);
  Route::get('{ligne}/edit', [LignesController::class, 'edit']);
  Route::put('{ligne}', [LignesController::class, 'update']);
  Route::get('create', [LignesController::class, 'create']);
  Route::post('/', [LignesController::class, 'store']);
  Route::delete('{ligne}', [LignesController::class, 'destroy']);
});

Route::prefix('armateurs')->group(function () {
  Route::get('/', [ArmateursController::class, 'index']);
  Route::get('{armateur}/edit', [ArmateursController::class, 'edit']);
  Route::put('{armateur}', [ArmateursController::class, 'update']);
  Route::get('create', [ArmateursController::class, 'create']);
  Route::post('/', [ArmateursController::class, 'store']);
  Route::delete('{armateur}', [ArmateursController::class, 'destroy']);
});

Route::prefix('history')->group(function () {
  Route::get('/', [HistoryController::class, 'index']);
  Route::delete('{history}', [HistoryController::class, 'destroy']);
});

Route::prefix('doubles')->group(function () {
  Route::get('/', [DoublesController::class, 'index']);
  Route::delete('{double}', [DoublesController::class, 'destroy']);
});

Route::prefix('export')->group(function () {
  Route::prefix('armateurs')->group(function () {
    Route::get('excel', [ArmateursController::class, 'excel'])->name('export.armateurs.excel');
    Route::get('csv', [ArmateursController::class, 'csv'])->name('export.armateurs.csv');
  });

  Route::prefix('navires')->group(function () {
    Route::get('excel', [NaviresController::class, 'excel'])->name('export.navires.excel');
    Route::get('csv', [NaviresController::class, 'csv'])->name('export.navires.csv');
  });

  Route::prefix('lignes')->group(function () {
    Route::get('excel', [LignesController::class, 'excel'])->name('export.lignes.excel');
    Route::get('csv', [LignesController::class, 'csv'])->name('export.lignes.csv');
  });

  Route::prefix('operations')->group(function () {
    Route::get('excel', [OperationsController::class, 'excel'])->name('export.operations.excel');
    Route::get('csv', [OperationsController::class, 'csv'])->name('export.operations.csv');
  });

  Route::prefix('users')->group(function () {
    Route::get('excel', [UserRoleController::class, 'excel'])->name('export.users.excel');
    Route::get('csv', [UserRoleController::class, 'csv'])->name('export.users.csv');
  });

  Route::prefix('history')->group(function () {
    Route::get('excel', [HistoryController::class, 'excel'])->name('export.history.excel');
    Route::get('csv', [HistoryController::class, 'csv'])->name('export.history.csv');
  });

  Route::prefix('doubles')->group(function () {
    Route::get('excel', [DoublesController::class, 'excel'])->name('export.doubles.excel');
    Route::get('csv', [DoublesController::class, 'csv'])->name('export.doubles.csv');
  });
});


Route::prefix('users')->group(function () {
  Route::get('/', [UserRoleController::class, 'index']);
  Route::get('/{user}/edit', [UserRoleController::class, 'edit']);
  Route::put('/{user}', [UserRoleController::class, 'update']);

  Route::get('create', [UserRoleController::class, 'create']);
  Route::post('/', [UserRoleController::class, 'store']);
  Route::delete('/{user}', [UserRoleController::class, 'destroy']);
});

Route::prefix('import')->group(function () {
  Route::get('armateurs', [ArmateursController::class, 'import'])->name('import.armateurs');
  Route::get('navires', [NaviresController::class, 'import'])->name('import.navires');
});

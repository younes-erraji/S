<?php

use App\Http\Controllers\Admin\{
  ArmateursController,
  LignesController,
  NaviresController,
  OperationsController,
  AdminController,
  UserRoleController
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
  Route::put('{navire}', [NaviresController::class, 'update']);
  Route::get('create', [NaviresController::class, 'create']);
  Route::post('/', [NaviresController::class, 'store']);
  Route::delete('{navire}', [NaviresController::class, 'destroy']);
});

Route::prefix('users')->group(function () {
  Route::get('/', [UserRoleController::class, 'index']);
  Route::get('/{user}/edit', [UserRoleController::class, 'edit']);
  Route::put('/{user}', [UserRoleController::class, 'update']);
});

Route::prefix('export')->group(function () {
  Route::prefix('navires')->group(function () {
    Route::get('excel', [NaviresController::class, 'excel'])->name('export.navires.excel');
    Route::get('csv', [NaviresController::class, 'csv'])->name('export.navires.csv');
  });
});

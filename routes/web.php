<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/dashboard/users', UserController::class)->middleware(['auth', 'verified']);

// Unit Management Routes
Route::controller(UnitController::class)->group(function () {
    Route::get('/dashboard/units', 'index')->name('units.index')->middleware('auth');
});
Route::controller(UnitController::class)
    ->middleware(['auth', 'role:Super-Admin|Admin'])
    ->prefix('/dashboard/units')
    ->name('units.')
    ->group(function () {
        Route::get('/{unit}/edit', 'edit')->name('edit')->middleware('auth');
        Route::patch('/{unit}/update', 'update')->name('update')->middleware('auth');
        Route::get('/create', 'create')->name('create')->middleware('auth');
        Route::post('/store', 'store')->name('store')->middleware('auth');
        Route::delete('/{unit}/destroy', 'destroy')->name('destroy')->middleware('auth');
    });

// Station Management Routes
Route::controller(StationController::class)->group(function () {
    Route::get('/dashboard/stations', 'index')->name('stations.index')->middleware('auth');
    Route::get('/dashboard/stations/{station}/edit', 'edit')->name('stations.edit')->middleware('auth');
    Route::get('/dashboard/stations/create', 'create')->name('stations.create')->middleware('auth');
    Route::patch('/dashboard/stations/{station}/update', 'update')->name('stations.update')->middleware('auth');
    Route::post('/dashboard/stations/store', 'store')->name('stations.store')->middleware('auth');
    Route::delete('/dashboard/stations/{station}/destroy', 'destroy')->name('stations.destroy')->middleware('auth');
});

// Transaction Management Routes
Route::controller(TransactionController::class)->group(function () {
    Route::get('/dashboard/transactions', 'index')->name('transactions.index')->middleware('auth');
    Route::get('/dashboard/transactions-wtd', 'index')->name('transactions.index-wtd')->middleware('auth');
    Route::get('/dashboard/transactions-mtd', 'index')->name('transactions.index-mtd')->middleware('auth');
    Route::get('/dashboard/transactions/{transaction}/edit', 'edit')->name('transactions.edit')->middleware('auth');
    Route::patch('/dashboard/transactions/{transaction}/update', 'update')->name('transactions.update')->middleware('auth');
    Route::get('/dashboard/transactions/create', 'create')->name('transactions.create')->middleware('auth');
    Route::post('/dashboard/transactions/store', 'store')->name('transactions.store')->middleware('auth');
    Route::delete('/dashboard/transactions/{transaction}/destroy', 'destroy')->name('transactions.destroy')->middleware('auth');
});

// Voucher Management Router
Route::controller(VoucherController::class)
    ->middleware(['auth', 'role:Super-Admin|Admin'])
    ->prefix('/dashboard/vouchers')
    ->name('vouchers.')
    ->group(function () {

        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{voucher}/edit', 'edit')->name('edit');
        Route::patch('/{voucher}/update', 'update')->name('update');
        Route::delete('/{voucher}/destroy', 'destroy')->name('destroy');

        // Thermal print
        Route::get('/print/{id}', 'thermal')->name('thermal');
    });


// Report Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/reports', [ReportController::class, 'index'])->name('reports.index');
});

require __DIR__.'/auth.php';

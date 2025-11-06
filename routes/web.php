<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class)->middleware(['auth', 'verified']);

// Unit Management Routes
Route::controller(UnitController::class)->group(function () {
    Route::get('/dashboard/units', 'index')->name('units.index')->middleware('auth');
    Route::get('/dashboard/units/{unit}/edit', 'edit')->name('units.edit')->middleware('auth');
    Route::patch('/dashboard/units/{unit}/update', 'update')->name('units.update')->middleware('auth');
    Route::get('/dashboard/units/create', 'create')->name('units.create')->middleware('auth');
    Route::post('/dashboard/units/store', 'store')->name('units.store')->middleware('auth');
    Route::delete('/dashboard/units/{unit}/destroy', 'destroy')->name('units.destroy')->middleware('auth');
});

// Station Management Routes
Route::controller(StationController::class)->group(function () {
    Route::get('/dashboard/stations', 'index')->name('stations.index')->middleware('auth');
    Route::get('/dashboard/stations/{station}/edit', 'edit')->name('stations.edit')->middleware('auth');
    Route::get('/dashboard/stations/create', 'create')->name('stations.create')->middleware('auth');
    Route::post('/dashboard/stations/store', 'store')->name('stations.store')->middleware('auth');
    Route::delete('/dashboard/stations/{station}/destroy', 'destroy')->name('stations.destroy')->middleware('auth');
});  

require __DIR__.'/auth.php';

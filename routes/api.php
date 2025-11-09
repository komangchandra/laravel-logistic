<?php

use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function () {
    Route::apiResource('units', UnitController::class);
});

Route::name('api.')->group(function () {
    Route::apiResource('stations', StationController::class);
});

Route::name('api.')->group(function () {
    Route::apiResource('transactions', TransactionController::class);
});
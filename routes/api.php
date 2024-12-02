<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\carController;
use App\Http\Controllers\prestamoController;

Route::get('/cars', [carController::class, 'index']);

Route::get('/cars/{id}',  [carController::class, 'show']);

Route::post('/cars', [carController::class, 'store']);

Route::put('/cars/{id}', [carController::class, 'update']);

Route::patch('/cars/{id}', [carController::class, 'updatePartial']);

Route::delete('/cars/{id}', [carController::class, 'destroy']);

Route::get('/prestamos', [prestamoController::class, 'index']);

Route::get('/prestamos/{id}', [prestamoController::class, 'show']);

Route::post('/prestamos', [prestamoController::class, 'store']);

Route::put('/prestamos/{id}', [prestamoController::class, 'update']);

Route::patch('/prestamos/{id}', [prestamoController::class, 'updatePartial']);

Route::delete('/prestamos/{id}', [prestamoController::class, 'destroy']);
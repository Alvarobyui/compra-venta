<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


 
Route::controller(UserController::class)->group(function () {
    Route::get('/usuarios/', 'index');
    Route::get('/usuarios/{id}', 'show');
    Route::post('/usuarios/', 'create');
    Route::put('/usuarios/{id}', 'update');
    Route::delete('/usuarios/{id}', 'destroy');
});

Route::controller(ProductoController::class)->group(function () {
    Route::get('/productos/', 'index');
    Route::get('/productos/{id}', 'show');
    Route::post('/productos/', 'create');
    Route::put('/productos/{id}', 'update');
    Route::delete('/productos/{id}', 'destroy');
});

Route::controller(CompraController::class)->group(function () {
    Route::get('/compras/', 'index');
    Route::get('/compras/{id}', 'show');
    Route::post('/compras/', 'create');
    Route::put('/compras/{id}', 'update');
    Route::delete('/compras/{id}', 'destroy');
});

Route::controller(VentaController::class)->group(function () {
    Route::get('/ventas/', 'index');
    Route::get('/ventas/{id}', 'show');
    Route::post('/ventas/', 'create');
    Route::put('/ventas/{id}', 'update');
    Route::delete('/ventas/{id}', 'destroy');
});
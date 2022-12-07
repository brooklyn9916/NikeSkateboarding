<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/sepatus', SepatuController::class)->except(
    ['create','edit','delete']
);

Route::resource('/orders', OrderController::class)->except(
    ['create','edit','delete']
);

Route::resource('/transaksi', TransaksiController::class)->except(
    ['create','edit','delete']
);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/sepatus', [SepatuController::class, 'store']);
    Route::put('/sepatus{id}', [SepatuController::class, 'update']);
    Route::delete('/sepatus{id}',[SepatuController::class, 'destroy']); 
    Route::post('/logout', [AuthController::class, 'logout']); 

    Route::resource('/orders', OrderController::class);
    Route::resource('/transaksi', TransaksiController::class);
     
});
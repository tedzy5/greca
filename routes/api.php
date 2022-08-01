<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/clients', [ClientController::class, 'create']);
Route::apiResource('clients', ClientController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('bookings', BookingController::class);
Route::get('/reserved/bookings/{id}', [ClientController::class, 'bookings']);
Route::get('/available/bookings', [BookingController::class, 'availableBookings']);
Route::get('/unavailable/bookings', [BookingController::class, 'unavailableBookings']);

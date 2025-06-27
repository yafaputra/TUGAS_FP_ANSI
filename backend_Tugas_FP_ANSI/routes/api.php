<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController; // Import controller Anda

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

// Route untuk mendapatkan semua venue
Route::get('/venues', [VenueController::class, 'index']);

// Route untuk mendapatkan detail venue (jika diperlukan)
Route::get('/venues/{venue}', [VenueController::class, 'show']);

// Route untuk membuat venue baru (jika diperlukan dari sisi admin/backend)
Route::post('/venues', [VenueController::class, 'store']);
<?php

use App\Http\Controllers\Api\ProspectController;
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

Route::middleware(['auth:sanctum', 'abilities:prospects:manage'])->group(function () {
    Route::get('/prospects', [ProspectController::class, 'index']);
    Route::post('/prospects', [ProspectController::class, 'store']);
    Route::post('/prospects/{prospect}/promote', [ProspectController::class, 'promote']);
});

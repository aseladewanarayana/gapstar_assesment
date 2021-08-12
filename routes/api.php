<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/customer', [CustomerController::class, 'store']);
Route::get('/customer/{id}', [CustomerController::class, 'show']);
Route::put('/customer/{id}', [CustomerController::class, 'update']);


Route::group(['middleware' => ['auth:sanctum']],  function () {
    Route::get('/customer/search/{id}', [CustomerController::class, 'search']);  
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

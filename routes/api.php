<?php

use App\Http\Controllers\Api\HouseController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\OrderedSearchController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SponsoredHouseController;
use App\Http\Controllers\MessageController;
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

Route::get('houses', [HouseController::class, 'index']);

Route::get('sponsoredHouses', [SponsoredHouseController::class, 'index']);

Route::get('image', [ImageController::class, 'index']);

Route::get('services', [ServiceController::class, 'index']);

Route::post('messages', [MessageController::class, 'store']);

Route::get('houses/{id}', [HouseController::class, 'show']);

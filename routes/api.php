<?php

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

Route::resource('cars', CarsController::class);
Route::resource('brand', BrandController::class);

Route::post('search/{term}', [
    'uses' => 'CarsController@search',
    'as' => 'search',
]);


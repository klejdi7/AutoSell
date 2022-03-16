<?php

use Illuminate\Support\Facades\Route;
// use Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/
 


Auth::routes();

Route::view('/', 'frontend')->name('home');
Route::view('/cart', 'frontend')->name('home');
Route::view('/login', 'frontend')->name('lg');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::group(['prefix' => 'cart', 'as' => 'cart'], function() {

        Route::get('cart', [
            'uses' => 'App\Http\Controllers\CartController@index',
            'as' => 'cart',
        ]);

        Route::post('addToCart', [
            'uses' => 'App\Http\Controllers\CartController@addToCart',
            'as' => 'add',
        ]);

        Route::get('checkCart', [
            'uses' => 'App\Http\Controllers\CartController@show',
            'as' => 'show',
        ]);
        
        Route::post('updateItem/{id}', [
            'uses' => 'App\Http\Controllers\CartController@edit',
            'as' => 'edit',
        ]);

        Route::delete('removeItem/{id}', [
            'uses' => 'App\Http\Controllers\CartController@destroy',
            'as' => 'destroy',
        ]);

        Route::post('checkout', [
            'uses' => 'App\Http\Controllers\CartController@checkout',
            'as' => 'edit',
        ]);
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin'], function() {

        Route::get('/', [
            'uses' => 'App\Http\Controllers\AdminController@index',
            'as' => 'admin',
        ]);

        Route::get('cars', [
            'uses' => 'App\Http\Controllers\AdminController@index',
            'as' => 'cars',
        ]);
        
        Route::get('brands', [
            'uses' => 'App\Http\Controllers\AdminController@index',
            'as' => 'brands',
        ]);
    });


Route::group(['prefix' => 'data', 'as' => 'data'], function() {

    Route::get('user', [
        'uses' => 'App\Http\Controllers\UserController@index',
        'as' => 'index',
    ]);

    Route::post('login', [
        'uses' => 'App\Http\Controllers\Auth\LoginController@login',
        'as' => 'login',
    ]);

    Route::post('register', [
        'uses' => 'App\Http\Controllers\Auth\RegisterController@create',
        'as' => 'reg',
    ]);

});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use Wave\Facades\Wave;

// Authentication routes
Auth::routes();

// Voyager Admin routes
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::group(['middleware' => 'auth'], function () {
    Route::post('links', '\App\Http\Controllers\LinkController@add');
    Route::post('links/search', '\App\Http\Controllers\LinkController@search');
    Route::post('collections', '\App\Http\Controllers\CollectionController@add');
    Route::post('tags', '\App\Http\Controllers\TagController@add');
});
// Wave routes
Wave::routes();

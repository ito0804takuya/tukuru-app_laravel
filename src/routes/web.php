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


// Route::get('/products', 'ProductsController@index');
// Route::get('/products/create', 'ProductsController@create');
// Route::post('/products/store', 'ProductsController@store');
Route::resource('products', 'ProductsController');
Route::get('/', 'ProductsController@index');

Route::resource('parts', 'PartsController');
Auth::routes();



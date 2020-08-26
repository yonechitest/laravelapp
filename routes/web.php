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

Route::get('/', function () {
    return view('welcome');
});

Route::get('calcu-app','Calculator\ClculatorController@index');
Route::post('calcu-app','Calculator\ClculatorController@index');

Route::get('my-crud','crud\MainPageController@showProducts');
Route::post('my-crud','crud\MainPageController@searchProducts');
Route::get('/my-crud/add','crud\MainPageController@addProduct');
Route::post('my-crud/add','crud\MainPageController@createProduct');
Route::get('my-crud/edit/{id?}', 'crud\MainPageController@editProduct');
Route::post('my-crud/edit/{id?}', 'crud\MainPageController@updateProduct');
Route::get('my-crud/delete/{id?}', 'crud\MainPageController@deleteProduct');
Route::post('my-crud/delete/{id?}', 'crud\MainPageController@destroyProduct');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

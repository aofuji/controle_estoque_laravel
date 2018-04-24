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

;
Route::get('/','ProdutoController@index');

Route::get('/entrada','EntradaController@index');
Route::post('/entrada','EntradaController@store');

Route::get('/saida','SaidaController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function(){
    Route::resource('home', 'HomeController');
});
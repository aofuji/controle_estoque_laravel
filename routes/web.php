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

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('','HomeController@index')->name('home');

        Route::prefix('estoque')->group(function () {
            Route::get('','EstoqueController@index')->name('estoque');
        });
        
        Route::prefix('entrada')->group(function () {
            Route::get('','EntradaController@index')->name('entrada');
            Route::post('','EntradaController@store')->name('entrada.store');
        });

        Route::prefix('saida')->group(function () {
            Route::get('','SaidaController@index')->name('saida');
        });

        Route::prefix('produto')->group(function () {
            Route::get('','ProdutoController@ListaProdutos');
        });
});
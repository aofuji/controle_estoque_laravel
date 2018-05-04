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
            Route::get('lista','EstoqueController@ListaProdutos');
        });
        
        Route::prefix('entrada')->group(function () {
            Route::get('','EntradaController@index')->name('entrada');
            Route::get('lista','EntradaController@listaEntrada');
            Route::post('','EntradaController@store')->name('entrada.store');
            Route::get('show/{id}','EntradaController@show')->name('entrada.show');
            Route::get('edit/{id}', 'EntradaController@edit')->name('entrada.edit');
            Route::post('update/{id}', 'EntradaController@update')->name('entrada.update');
            Route::get('delete/{id}', 'EntradaController@destroy')->name('entrada.delete');
            Route::any('search','EntradaController@searchEntrada');
        });

        Route::prefix('saida')->group(function () {
            Route::get('','SaidaController@index')->name('saida');
            Route::post('','SaidaController@store')->name('saida.store');
            Route::get('edit/{id}', 'SaidaController@edit')->name('saida.edit');
            Route::post('update/{id}', 'SaidaController@update')->name('saida.update');
            Route::post('delete/{id}', 'SaidaController@destroy')->name('saida.delete');
        });

        Route::prefix('produto')->group(function () {
            Route::get('','ProdutoController@index')->name('produto');
        });

        Route::prefix('categoria')->group(function () {
            Route::get('','CategoriaController@index')->name('categoria');
        });
});
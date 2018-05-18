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
            Route::get('form','EstoqueController@form')->name('form.estoque');
            Route::post('form','EstoqueController@store')->name('form.store');
            Route::any('', 'EstoqueController@searchEstoque')->name('estoque.search');
            Route::get('show/{id}', 'EstoqueController@show')->name('estoque.show');
            Route::post('delete/{id}', 'EstoqueController@destroy')->name('estoque.delete');
            Route::get('edit/{id}', 'EstoqueController@edit')->name('estoque.edit');
            Route::post('edit/{id}', 'EstoqueController@update')->name('estoque.update');
            Route::post('entrada/{id}','EstoqueController@entrada')->name('estoque.entrada');
            Route::post('saida/{id}','EstoqueController@saida')->name('estoque.saida');
            Route::get('lista','EstoqueController@ListaProdutos');
        });
        
        Route::prefix('cliente')->group(function () {
            Route::get('','ClienteController@index')->name('cliente');
            Route::get('form','ClienteController@form')->name('form.cliente');
            Route::post('form','ClienteController@store')->name('cliente.store');
            Route::get('edit/{id}', 'ClienteController@edit')->name('cliente.edit');
            Route::post('edit/{id}', 'ClienteController@update')->name('cliente.update');
            Route::post('delete/{id}', 'ClienteController@destroy')->name('cliente.delete');
            Route::get('show/{id}', 'ClienteController@show')->name('cliente.show');
            Route::any('', 'ClienteController@searchCliente')->name('cliente.search');
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
            Route::any('search', 'SaidaController@searchSaida')->name('saida.search');
        });

        Route::prefix('produto')->group(function () {
            Route::get('','ProdutoController@index')->name('produto');
        });

        Route::prefix('categoria')->group(function () {
            Route::get('','CategoriaController@index')->name('categoria');
        });
});
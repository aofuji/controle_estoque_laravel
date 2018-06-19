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

Route::middleware(['auth'])->group(function () {
	Route::get('', 'HomeController@index')->name('home');

	Route::prefix('estoque')->group(function () {
		Route::get('', 'EstoqueController@index')->name('estoque');	
		Route::post('lista', 'EstoqueController@listaEstoque');
		Route::get('listacategoria', 'EstoqueController@listaCategoria');
		Route::post('cadastrar', 'EstoqueController@store');
		Route::post('import', 'EstoqueController@import');
		Route::get('show/{id}', 'EstoqueController@show');
		Route::post('edit/{id}', 'EstoqueController@update');
		Route::post('entrada/{id}', 'EstoqueController@entrada');
		Route::get('cliente', 'EstoqueController@listaCliente');
		Route::post('saida/{id}', 'EstoqueController@saida');
		Route::get('history/{id}', 'EstoqueController@historyView');
		Route::post('history/{id}', 'EstoqueController@historyView');
		Route::delete('delete/{id}', 'EstoqueController@destroy');
		
	});

	Route::prefix('cliente')->group(function () {
		Route::get('', 'ClienteController@index')->name('cliente');
		Route::get('lista', 'ClienteController@listaCliente');
		Route::post('lista', 'ClienteController@listaCliente');
		Route::post('cadastrar', 'ClienteController@store');
		Route::get('show/{id}', 'ClienteController@show');
		Route::post('edit/{id}', 'ClienteController@update');
		Route::delete('delete/{id}', 'ClienteController@destroy');
		
	});

	Route::prefix('categoria')->group(function () {
		Route::get('', 'CategoriaController@index')->name('categoria');
		Route::get('lista', 'CategoriaController@listaCliente');
		Route::post('lista', 'CategoriaController@listaCliente');
		Route::post('form', 'CategoriaController@store');
		Route::post('import', 'CategoriaController@import')->name('categoria.import');
		Route::get('show/{id}', 'CategoriaController@show');
		Route::post('edit/{id}', 'CategoriaController@update');
		Route::delete('delete/{id}', 'CategoriaController@destroy');
	});

	Route::prefix('historico')->group(function () {
		Route::get('', 'HistoricoController@index')->name('historico');
		Route::post('', 'HistoricoController@searchHistorico')->name('historico.search');

	});
	Route::prefix('user')->group(function () {
		Route::get('', 'UserController@index')->name('user');
		Route::post('form', 'UserController@store')->name('user.store');
		Route::get('show/{id}', 'UserController@show')->name('user.show');
		Route::post('edit/{id}', 'UserController@update')->name('user.update');
		Route::post('delete/{id}', 'UserController@destroy')->name('user.delete');

	});
	Route::prefix('report')->group(function () {
		Route::get('historicoall', 'ReportController@historicoall')->name('report.historicoall');
		Route::get('{id}', 'ReportController@historico')->name('report.historico');

		Route::get('lista/{id}', 'ReportController@lista')->name('report.lista');

	});
});
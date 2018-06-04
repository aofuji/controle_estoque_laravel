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
		Route::post('form', 'EstoqueController@store')->name('form.store');
		Route::any('', 'EstoqueController@searchEstoque')->name('estoque.search');
		Route::post('import', 'EstoqueController@import')->name('estoque.import');
		Route::get('show/{id}', 'EstoqueController@show')->name('estoque.show');
		Route::post('delete/{id}', 'EstoqueController@destroy')->name('estoque.delete');
		Route::get('edit/{id}', 'EstoqueController@edit')->name('estoque.edit');
		Route::post('edit/{id}', 'EstoqueController@update')->name('estoque.update');
		Route::get('entrada/{id}', 'EstoqueController@entradaForm')->name('estoque.entradaform');
		Route::post('entrada/{id}', 'EstoqueController@entrada')->name('estoque.entrada');
		Route::get('saida/{id}', 'EstoqueController@saidaForm')->name('estoque.saidaform');
		Route::post('saida/{id}', 'EstoqueController@saida')->name('estoque.saida');
		Route::get('historico/{id}', 'EstoqueController@historicoView')->name('estoque.historicoview');
		Route::post('historico/{id}', 'EstoqueController@historicoSearch')->name('estoque.historicosearch');
	});

	Route::prefix('cliente')->group(function () {
		Route::get('', 'ClienteController@index')->name('cliente');
		Route::post('form', 'ClienteController@store')->name('cliente.store');
		Route::get('edit/{id}', 'ClienteController@edit')->name('cliente.edit');
		Route::post('edit/{id}', 'ClienteController@update')->name('cliente.update');
		Route::post('delete/{id}', 'ClienteController@destroy')->name('cliente.delete');
		Route::get('show/{id}', 'ClienteController@show')->name('cliente.show');
		Route::any('', 'ClienteController@searchCliente')->name('cliente.search');
	});

	Route::prefix('categoria')->group(function () {
		Route::get('', 'CategoriaController@index')->name('categoria');
		Route::post('form', 'CategoriaController@store')->name('categoria.store');
		Route::post('import', 'CategoriaController@import')->name('categoria.import');
		Route::get('show/{id}', 'CategoriaController@show')->name('categoria.show');
		Route::post('edit/{id}', 'CategoriaController@update')->name('categoria.update');
		Route::post('delete/{id}', 'CategoriaController@destroy')->name('categoria.delete');
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
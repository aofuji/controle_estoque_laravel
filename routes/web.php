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
		Route::get('', 'EstoqueController@index')->name('estoque')->middleware('can:view_estoque');	
		Route::post('lista', 'EstoqueController@listaEstoque')->middleware('can:view_estoque');
		Route::get('listacategoria', 'EstoqueController@listaCategoria')->middleware('can:view_estoque');
		Route::get('listaproduto', 'EstoqueController@listaProduto')->middleware('can:view_estoque');
		Route::post('cadastrar', 'EstoqueController@store')->middleware('can:add_estoque');
		Route::post('import', 'EstoqueController@import')->middleware('can:import_estoque');
		Route::get('show/{id}', 'EstoqueController@show')->middleware('can:view_estoque');
		Route::post('edit/{id}', 'EstoqueController@update');
		Route::post('entrada/{id}', 'EstoqueController@entrada');	
		Route::get('cliente', 'EstoqueController@listaCliente');
		Route::post('saida/{id}', 'EstoqueController@saida')->middleware('can:saida_estoque');
		Route::get('history/{id}', 'EstoqueController@historyView')->middleware('can:view_estoque');
		Route::post('history/{id}', 'EstoqueController@historyView')->middleware('can:view_estoque');
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
		Route::get('lista', 'HistoricoController@listaHistorico');
		Route::post('lista', 'HistoricoController@listaHistorico');
	});
	Route::prefix('user')->group(function () {
		Route::get('', 'UserController@index')->name('user')->middleware('can:page_user');	
		Route::get('lista', 'UserController@listaUser')->middleware('can:page_user');		
		Route::post('lista', 'UserController@listaUser')->middleware('can:page_user');		
		Route::post('form', 'UserController@store')->middleware('can:page_user');
		Route::get('roles', 'UserController@roles')->middleware('can:page_user');
		Route::post('updaterole', 'UserController@updateRole')->middleware('can:page_user');
		Route::get('show/{id}', 'UserController@show')->middleware('can:page_user');
		Route::get('role/{id}', 'UserController@role')->middleware('can:page_user');
		Route::post('edit/{id}', 'UserController@update')->middleware('can:page_user');
		Route::delete('delete/{id}', 'UserController@destroy')->name('user.delete')->middleware('can:page_user');

	});

	Route::prefix('permission')->group(function () {
		Route::get('', 'PermissionController@index')->name('permission')->middleware('can:page_permission');
	});

	Route::prefix('role')->group(function () {
		Route::get('', 'RoleController@index')->name('role')->middleware('can:page_role');
		Route::get('lista', 'RoleController@lista')->middleware('can:page_role');
		Route::get('permissions', 'RoleController@permissions')->middleware('can:page_role');
		Route::post('permission', 'RoleController@store')->middleware('can:page_role');
		Route::get('showpermission/{id}', 'RoleController@showPermission')->middleware('can:page_role');
		Route::get('permission/{id}', 'RoleController@permission')->middleware('can:page_role');
		Route::delete('permission_delete/{id}', 'RoleController@destroy')->middleware('can:page_role');
		
	});

	Route::prefix('report')->group(function () {	
		Route::get('historicoall', 'ReportController@historicoall')->name('report.historicoall');
		Route::get('{id}', 'ReportController@historico')->name('report.historico');
		Route::get('lista/{id}', 'ReportController@lista')->name('report.lista');

	});
});
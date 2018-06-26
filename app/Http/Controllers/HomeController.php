<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Cliente;
use App\Models\Historico;

class HomeController extends Controller {
	
	public function index() {
		
		$produtos = Estoque::all();
		$clientes = Cliente::all();
		$saidas = Historico::where('tipo','saida')->whereMonth('created_at', '=', date('m'))->get();

		$total_saidas = Historico::where('tipo','saida')->whereMonth('created_at', '=', date('m'))->sum('valor_total');

		$contador_produtos = $produtos->count();
		$contador_clientes = $clientes->count();
		$contador_saidas = $saidas->count();


		return view('home', compact('contador_produtos','contador_clientes','contador_saidas', 'total_saidas'));
	}

	public function create() {
		//
	}

	
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}

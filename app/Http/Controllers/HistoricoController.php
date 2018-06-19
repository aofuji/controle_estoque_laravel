<?php

namespace App\Http\Controllers;

use App\Models\Historico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoricoController extends Controller {
	private $totalPage = 14;
	public function index() {
		

		return view('historico.historico');
	}

	public function listaHistorico(Request $request){
		$historico = DB::table('historicos')
		->where(function ($query) use ($request) {
			if ($request->nome_produto != null) {
				$query->where('estoque.nome_produto','like','%'. $request['nome_produto'] .'%');
			}
			if ($request->nome_cliente != null) {
				$query->where('clientes.nome','like','%'. $request['nome_cliente'] .'%');
			}
			if ($request->tipo != null) {
				$query->where('historicos.tipo', $request['tipo']);
			}
		})->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
			->leftJoin('estoque', 'estoque.id', '=', 'historicos.estoque_id')
			->select('historicos.*', 'clientes.nome', 'estoque.nome_produto')
			->orderby('historicos.id', 'desc')
			->paginate($this->totalPage);

			return response()->json($historico, 200);
	}



	public function create() {
		//
	}

	public function store(Request $request) {
		//
	}

	public function show($id) {
		//
	}

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

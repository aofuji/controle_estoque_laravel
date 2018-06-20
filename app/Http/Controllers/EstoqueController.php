<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Estoque;
use App\Models\Historico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Excel;

class EstoqueController extends Controller {
	private $totalPage = 12;

	public function index() {
		return view('estoque.estoque');
	}

	public function listaEstoque(Request $request){

		$lista = DB::table('estoque')
		->where(function ($query) use ($request) {
			if ($request->nome_produto != null) {
				$query->where('estoque.nome_produto','like','%'. $request['nome_produto'] .'%');
			}
			if ($request->qtd_estoque != null) {
				$query->where('estoque.qtd_estoque', $request['qtd_estoque']);
			}
		})->leftJoin('categorias', 'categorias.id', '=', 'estoque.categoria_id')
		  ->select('estoque.*', 'categorias.categoria')
		  ->orderby('estoque.id', 'desc')
		  ->paginate($this->totalPage);

			return response()->json($lista, 200);
	}

	public function listaCategoria(){
		$listaCategoria = Categoria::all(['categoria', 'id']);

		return response()->json($listaCategoria, 200);
	}

	public function import(Request $request){
		if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
//
            $data = Excel::load($path, function($reader){})->get();
                if(!empty($data) && $data->count()) {
					
					if(empty($data[0]->codigo_produto) && empty($data[0]->nome_produto) && empty($data[0]->qtd_estoque) && empty($data[0]->preco_custo) && empty($data[0]->preco_venda) && empty($data[0]->data) && empty($data[0]->categoria_id)){
						return response()->json(['erro'=>'Não contem colunas corretas']);
					}else{
						
						foreach ($data as $key => $value){				
							$estoque = new Estoque();
							$estoque->codigo_produto = $value->codigo_produto;
							$estoque->nome_produto = $value->nome_produto;
							$estoque->qtd_estoque = $value->qtd_estoque;
							$estoque->preco_custo = $value->preco_custo;
							$estoque->preco_venda = $value->preco_venda;
							$estoque->data = $value->data;
							$estoque->categoria_id = $value->categoria_id;
							$estoque->save();
						}
						return response()->json(['sucess'=>'Arquivo importado com sucesso!'],200);
					}
                }else{
					return response()->json(['erro'=>'Arquivo vazio!'],200);
				}
		}
		
	}


	public function entrada(Request $request, $id, Estoque $estoque) {

		$dt = Carbon::now();
		$dt->timezone = 'America/Sao_Paulo';

		$entrada = Estoque::find($id);

		$entrada->qtd_estoque = $entrada->qtd_estoque + $request->qtd_entrada;

		$data = $entrada->save();

		if ($data) {
			Historico::create(
				['tipo' => 'Entrada',
					'qtd' => $request->qtd_entrada,
					'valor_unitario' => $entrada->preco_custo,
					'valor_total' => $request->qtd_entrada * $entrada->preco_custo,
					'usuario' => Auth::user()->name,
					'cliente_id' => null,
					'obs' => 'teste',
					'estoque_id' => $entrada->id,
					'created_at' => $dt,
				]);
			return response()->json('Entrada Efetuado com sucesso', 201);
		}else{
			return response()->json('Erro',500);
		}

	}

	public function listaCliente() {

		$cliente = Cliente::all(['id','nome','rg']);
		return response()->json($cliente, 200);
		
	}

	public function saida(Request $request, $id) {
		$dt = Carbon::now();
		$dt->timezone = 'America/Sao_Paulo';

		$saida = Estoque::find($id);

		$saida->qtd_estoque = $saida->qtd_estoque - $request->qtd_saida;

		$data = $saida->save();

		if ($data) {
			Historico::create(
				['tipo' => 'Saida',
				'qtd' => $request->qtd_saida,
				'valor_unitario' => $saida->preco_venda,
				'valor_total' => $request->qtd_saida * $saida->preco_venda,
				'usuario' => Auth::user()->name,
				'cliente_id' => $request->cliente,
				'obs' => 'teste',
				'estoque_id' => $saida->id,
				'created_at' => $dt
				]);
				return response()->json('Saida Efetuado com sucesso', 201);
			}else{
				return response()->json('Erro',500);
			}
	}

	public function store(Request $request, Estoque $estoque) {
		$dt = Carbon::now();
		$dt->timezone = 'America/Sao_Paulo';

		$estoque->codigo_produto = $request->codigo_produto;
		$estoque->nome_produto = $request->nome_produto;
		$estoque->categoria_id = $request->categoria_id;
		$estoque->qtd_estoque = $request->qtd_estoque;
		$estoque->data = $dt;
		$estoque->preco_custo = str_replace(",", ".", $request->preco_custo);
		$estoque->preco_venda = str_replace(",", ".", $request->preco_venda);

		$data = $estoque->save();

		if($data){
			return response()->json('Cadastro Efetuado com sucesso', 201);
		}else{
			return response()->json('Erro',500);
		}
		
	}

	public function show($id) {
		$list = Estoque::find($id);
		return response()->json($list,200);
	}

	public function historyView($id, Request $request){
		$historico = DB::table('historicos')
			->where(function ($query) use ($id, $request) {
				if ($request->id != null) {
					$query->where('estoque_id', $id);
				}

				if ($request->tipo != null) {
					$query->where('tipo', $request['tipo']);
				}

				if ($request->nome_cliente != null) {
					$query->where('clientes.nome','like','%'. $request['nome_cliente'] .'%');
				}

			})->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
			->select('historicos.*', 'clientes.nome')
			->orderby('historicos.id', 'desc')
			->paginate(9);

		

			return response()->json($historico,200);
	}

	public function update(Request $request, $id) {
	
		$estoque = Estoque::find($id);
		$estoque->codigo_produto = $request->codigo_produto;
		$estoque->nome_produto = $request->nome_produto;
		$estoque->categoria_id = $request->categoria_id;
		$estoque->qtd_estoque = $request->qtd_estoque;
		$estoque->preco_custo = str_replace(",", ".", $request->preco_custo);
		$estoque->preco_venda = str_replace(",", ".", $request->preco_venda);

		$data = $estoque->save();
		if($data){
			return response()->json('Atualizado com sucesso', 201);
		}else{
			return response()->json('Erro',500);
		}
	}

	public function destroy($id) {
		$estoque = Estoque::find($id);
		$data = $estoque->delete();
		if($data){
			return response()->json('Deletado com sucesso', 200);
		}
		
	}
}

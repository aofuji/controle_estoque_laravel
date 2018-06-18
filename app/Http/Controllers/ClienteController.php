<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller {
	private $totalPage = 7;

	public function index() {
		$lista = DB::table('clientes')
			->orderby('id', 'desc')
			->paginate($this->totalPage);

		$contador = count($lista);

		return view('cliente.cliente', compact('lista', 'contador'));
	}

	public function searchCliente(Request $request, Cliente $cliente) {
		$dataForm = $request->except('_token');
		$lista = $cliente->search($dataForm, $this->totalPage);
		$contador = count($lista);
		return view('cliente.cliente', compact('lista', 'dataForm', 'contador'));
	}

	public function create() {
		//
	}

	public function store(Request $request, Cliente $cliente) {
		$lista_cliente = Cliente::all();

		foreach ($lista_cliente as $value) {
			if ($value->rg == $request->rg) {
				return response()->json(['erro'=>'Existe esse RG no sistema, não foi possivel realizar o cadastro!!']);
			}
		}

		$cliente->nome = $request->nome;
		$cliente->rg = $request->rg;
		$cliente->cpf = $request->cpf;
		$cliente->endereco = $request->endereco;
		$cliente->cidade = $request->cidade;
		$cliente->estado = $request->estado;
		$cliente->cep = $request->cep;
		$cliente->telefone = $request->telefone;
		$cliente->celular = $request->celular;
		$cliente->email = $request->email;
		$cliente->data_nascimento = $request->data_nascimento;

		$data = $cliente->save();
		if ($data) {
			return response()->json(['sucess'=>'Cadastro efetuado com sucesso'],201);
		}else{
			return response()->json('Erro',500);
		}
	}

	public function show($id) {
		$list = Cliente::find($id);
		return response()->json($list, 200);
	}

	public function edit($id) {
		$cliente = Cliente::find($id);

		return view('cliente.editform', compact('cliente'))
		->with('clienteedit','clienteedit');
	}

	public function update(Request $request, $id) {
		$cliente = Cliente::find($id);
		$cliente->nome = $request->nome;
		$cliente->rg = $request->rg;
		$cliente->cpf = $request->cpf;
		$cliente->endereco = $request->endereco;
		$cliente->cidade = $request->cidade;
		$cliente->estado = $request->estado;
		$cliente->cep = $request->cep;
		$cliente->telefone = $request->telefone;
		$cliente->celular = $request->celular;
		$cliente->email = $request->email;
		$cliente->data_nascimento = $request->data_nascimento;

		$data = $cliente->save();
		if ($data) {
			return redirect()
				->back()
				->with('success', 'Atualizado com Sucesso!');
		}

		return redirect()
			->back()
			->with('error', 'Falha ao atualizar');
	}

	public function destroy($id) {
		$cliente = Cliente::find($id);

		$data = $cliente->delete();
		return redirect()
			->back()
			->with('success', 'Sucesso ao Deletar');
	}
}

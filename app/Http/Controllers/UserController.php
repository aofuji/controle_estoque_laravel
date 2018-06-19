<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function index() {
		return view('user.user');
	}

	public function listaUser(Request $request){
		$lista = User::all();
		return response()->json($lista, 200);
	}

	public function create() {
		//
	}

	public function store(Request $request, User $user) {
		$user->name = $request->name;
		$user->email = $request->email;
		$user->nivel_acesso = $request->nivel_acesso;
		$user->password = bcrypt($request->password);

		$data = $user->save();
		if ($data) {
			return response()->json('Cadastro efetuado com sucesso',201);
		}else{
			return response()->json('Erro',500);
		}
	}

	public function show($id) {
		$list = User::find($id);
		return response()->json($list, 200);
	}

	public function edit($id) {
		//
	}

	public function update(Request $request, $id) {

		$user = User::findOrFail($id);
		if ($user['password'] != null) {
			$user->password = bcrypt($request['password']);
		}

		$user->name = $request->name;
		$user->email = $request->email;
		$user->nivel_acesso = $request->nivel_acesso;
		$update = $user->save();
		if($update){
			return response()->json('Atualizado com sucesso', 201);
		}else{
			return response()->json('Erro',500);
		}

	}

	public function destroy($id) {
		$user = User::find($id);

		$data = $user->delete();
		if($data){
			return response()->json('Deletado com sucesso', 200);
		}
	}
}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function index() {

		$lista = User::all();
		$contador = count($lista);

		return view('user.user', compact('lista', 'contador'));
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
			return redirect()
				->route('user')
				->with('success', 'Sucesso ao cadastrar');
		}

		return redirect()
			->back()
			->with('error', 'Falha ao carregar');
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
		if ($update) {
			return redirect()
				->back()
				->with('success', 'Sucesso ao atualizar');
		} else {
			return redirect()
				->back()
				->with('error', 'Falha ao carregar');
		}

	}

	public function destroy($id) {
		$user = User::find($id);

		$data = $user->delete();
		return redirect()
			->back()
			->with('success', 'Sucesso ao Deletar');
	}
}

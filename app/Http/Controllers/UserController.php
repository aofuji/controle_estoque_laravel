<?php

namespace App\Http\Controllers;

use App\User;
use Gate;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller {

	private $user;
	
    
    public function __construct(User $user)
    {
		$this->user = $user;
		
        
        
    }

	public function index() {
            
		return view('user.user');
	}

	public function listaUser(Request $request){
		$lista = User::where('id','!=', 3)->get();
		return response()->json($lista, 200);
	}

	public function create() {
		//
	}

	public function store(Request $request, User $user) {
		$user->name = $request->name;
		$user->email = $request->email;
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

	public function roles(){
		$roles = Role::where('id','!=', 3)->get();

		return response()->json($roles,200);
	}

	

	public function role($id)
    {
        
        $roles = $this->user->find($id)->roles;
        
        
        
        return response()->json($roles, 200);
    }

	public function updateRole(Request $request){

		$role = DB::table('role_user')
		->where('user_id', $request->user_id)
		->get();

		if($role->count() == 0){
			$data = DB::table('role_user')->insert(
				['user_id' => $request->user_id, 'role_id' => $request->role_id]
			);
			if($data)
				return response()->json('Cargo registrado!',201);
		}else if($role[0]->user_id == $request->user_id && $role[0]->role_id == $request->role_id) {
			return response()->json('Não foi Atualizado, esses dados ja se encontra iguais no Sistema!');
		}else{
			$data = DB::table('role_user')
				->where('user_id', $request->user_id)
				->update([
					'role_id' => $request->user_id,
					'role_id' => $request->role_id
					]);
			if($data)
				return response()->json('Atualizado Cargo!',200);
		}

	}

	public function update(Request $request, $id) {

		$user = User::findOrFail($id);
		if ($user['password'] != null) {
			$user->password = bcrypt($request['password']);
		}

		$user->name = $request->name;
		$user->email = $request->email;
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

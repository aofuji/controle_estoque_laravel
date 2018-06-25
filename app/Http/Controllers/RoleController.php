<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Gate;
class RoleController extends Controller
{
    private $role;
    
    public function __construct(Role $role)
    {
        $this->role = $role;
       
        
    }

    public function index()
    {
        return view('role.role');
    }

    public function lista(){
        $roles = $this->role->where('id','!=',3)->get();
        return response()->json($roles, 200);
    }

    public function permission($id)
    {
        //Recupera o role
       // $role = $this->role->find($id);
        
        //recuperar permissões
       // $permission = $role->permissions()->get();
        
        $permission = DB::table('permissions')
        ->where('role_id', $id)
        ->leftJoin('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
        ->get();

        return response()->json($permission,200);
    }

    public function permissions(){
        $permissions = Permission::all();

        return response()->json($permissions, 200);
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $data = DB::table('permission_role')
		->insert(
            ['permission_id' => $request->permission_id, 'role_id' => $request->role_id]
        );
		
        if($data)
            return response()->json('Permissão cadastrado');
        
    }

   
    public function showPermission($id)
    {
        $permission = DB::table('permissions')
        ->where('permission_role.id', $id)
        ->join('permission_role', 'permissions.id', '=', 'permission_role.role_id')
        ->get();

        return response()->json($permission,200);
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        $data = DB::table('permission_role')
            ->where('id', $id)
            ->delete();
        if($data)
            return response()->json('Permissão Deletado com Sucesso!');
    }
}

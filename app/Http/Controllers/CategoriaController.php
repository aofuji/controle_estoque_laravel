<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

use Excel;

class CategoriaController extends Controller
{
    private $totalPage = 7;
   

    public function index()
    {
        return view('categoria.categoria');
    }

    public function listaCliente(Request $request){
        $lista = DB::table('categorias')
        ->where('categoria','like', '%'. $request->categoria.'%')
        ->orderby('id','desc')
        ->paginate($this->totalPage);

        return response()->json($lista,200);
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $data = Categoria::create([
            'categoria'=> $request->categoria
        ]);

        if ($data) {
			return response()->json('Cadastro efetuado com sucesso',201);
		}else{
			return response()->json('Erro',500);
		}
    }

 
    public function show($id)
    {
        $list = Categoria::find($id);
        return response()->json($list, 200);
    }

    public function import(Request $request){
        if($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();

            $data = Excel::load($path, function($reader){})->get();
                if(!empty($data) && $data->count()) {
                    foreach ($data as $key => $value){
                        $categoria = new Categoria();
                        $categoria->categoria = $value->categoria;
                        $categoria->save();
                    }
                }
        }
        return redirect() 
                    ->route('categoria')
                    ->with('success',  'Importado com Sucesso!');
    }

    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        $categoria->categoria = $request->categoria;
        $data = $categoria->save();
        if($data){
			return response()->json('Atualizado com sucesso', 201);
		}else{
			return response()->json('Erro',500);
		}
    }

 
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        $data = $categoria->delete();
        if($data){
			return response()->json('Deletado com sucesso', 200);
		}
    }
}

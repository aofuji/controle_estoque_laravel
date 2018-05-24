<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    private $totalPage = 7;

    public function index()
    {
        $lista = DB::table('categorias')
        ->orderby('id','desc')
        ->paginate($this->totalPage);
        $contador = count($lista);
        return view('categoria.categoria', compact('lista','contador'));
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

        if($data)
            return redirect() 
                    ->route('categoria') 
                    ->with('success',  'Entrada efetuado com sucesso!');
            return redirect()
                    ->back()
                    ->with('error',['message' => 'Falha ao carregar']);
    }

 
    public function show($id)
    {
        $list = Categoria::find($id);
        return response()->json($list, 200);
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
        if($data)
            return redirect() 
                    ->route('categoria')
                    ->with('success',  'Atualizado com Sucesso!');
            return redirect()
                    ->back()
                    ->with('error',['message' => 'Falha ao atualizar']);
    }

 
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        $data = $categoria->delete();
        return redirect()
            ->back()
            ->with('success',  'Sucesso ao Deletar');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Entrada;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Saida;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EntradaController extends Controller
{
    
    public function index()
    {
        return view('entrada');
    }

    public function listaEntrada(){
        $list = DB::table('entrada_produtos')
            ->leftJoin('produtos', 'produtos.id', '=', 'entrada_produtos.produto_id')
            ->select('entrada_produtos.*', 'produtos.nome_produto')
            ->paginate(4);
            
        return response()->json($list, 200);
    }
    
    public function create()
    {
        //
    }

   
    public function store(Request $request, Entrada $entrada)
    {

        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        $entrada->qtd_entrada = $request->qtd_entrada;
        $entrada->valor = str_replace(",",".", $request->valor);
        $entrada->produto_id = $request->produto_id;
        $entrada->created_at = $dt;
        $entrada->updated_at = $dt;
        $data = $entrada->save();
        
        if($data)
            return response()->json('Cadastro Efetuado com sucesso', 201);
    
            return response()->json('Erro',500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = Categoria::find($id)->produto;

        echo json_encode($list);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Entrada::find($id);

        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        $update = Entrada::find($id);

        $update->qtd_entrada = $request->qtd_entrada;
        $update->valor = str_replace(",",".", $request->valor);
        $update->produto_id = $request->produto_id;
        $update->updated_at = $dt;

        $data = $update->save();

        if($data)
            return response()->json('Atualizado com sucesso');

           
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entrada = Entrada::find($id);

        $data = $entrada->delete();
        
            return response()->json('Entrada deletado com sucesso');
    
    }
    

    
}

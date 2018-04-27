<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Entrada;
use Illuminate\Support\Facades\DB;

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
            ->get();

        return response()->json($list, 200);
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Entrada $entrada)
    {
        
        $entrada->qtd_entrada = $request->qtd_entrada;
        $entrada->valor = $request->valor;
        $entrada->produto_id = $request->produto_id;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

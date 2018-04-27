<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produto;
use App\Models\Entrada;
use App\Models\Saida;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
   
    public function index()
    {
        return view('estoque');
    }

    public function listaProdutos(){
        $list = DB::table('produtos')
            ->leftJoin('categorias', 'categorias.id', '=', 'produtos.categoria_id')
            ->leftJoin('entrada_produtos', 'produtos.id', '=', 'entrada_produtos.produto_id')
            ->leftJoin('saida_produtos', 'produtos.id', '=', 'saida_produtos.produto_id')
            ->select('produtos.id','nome_produto','categorias.categoria','produtos.status', 
                DB::raw('count(entrada_produtos.produto_id) as qtd_registro_entrada '),
                DB::raw('count(saida_produtos.produto_id) as qtd_registro_saida '),
                DB::raw('COALESCE(SUM(entrada_produtos.qtd_entrada),0) as quantidade_entrada'), 
                DB::raw('COALESCE(SUM(saida_produtos.qtd_saida),0) as quantidade_saida'),
                DB::raw('COALESCE(SUM(entrada_produtos.qtd_entrada),0) - COALESCE(SUM(saida_produtos.qtd_saida),0)  as total'))    
            ->groupBy('produtos.id','nome_produto','categorias.categoria','produtos.status')
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
    public function store(Request $request)
    {
        //
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produto;
use App\Models\Entrada;
use App\Models\Saida;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    
    public function index()
    {
        $list= DB::table('produtos')
            ->leftJoin('categorias', 'categorias.id', '=', 'produtos.categoria_id')
            ->leftJoin('entrada_produtos', 'produtos.id', '=', 'entrada_produtos.produto_id')
            ->leftJoin('saida_produtos', 'produtos.id', '=', 'saida_produtos.produto_id')
            //->where('produtos.id', '=', 'entrada_produtos.produto_id')
            ->select('produtos.id','nome_produto','categorias.categoria', 
                DB::raw('SUM(entrada_produtos.qtd_entrada) as quantidade_entrada'), 
                DB::raw('SUM(saida_produtos.qtd_saida) as quantidade_saida'),
                DB::raw('SUM(entrada_produtos.qtd_entrada ) - SUM(saida_produtos.qtd_saida)  as total'))
            ->groupBy('produtos.id','nome_produto','categorias.categoria')
            ->get();
            
           // $list = DB::table('produtos')
           // ->select('id','nome_produto', DB::raw('SUM(status) as status'))
           // 
           // ->groupBy('id','nome_produto')
           // ->get();
     

        return response()->json($list, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

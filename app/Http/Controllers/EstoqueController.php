<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Produto;
use App\Models\Entrada;
use App\Models\Saida;
use App\Models\Categoria;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;

class EstoqueController extends Controller
{
    private $totalPage = 7;
   
    public function index()
    {

        $lista = DB::table('estoque')
        ->leftJoin('categorias', 'categorias.id', '=', 'estoque.categoria_id')
        ->select('estoque.*', 'categorias.categoria')
        ->orderby('estoque.id','desc')
        ->paginate($this->totalPage);
        
        return view('estoque.estoque', compact('lista'));
    }

    public function searchEstoque(Request $request, Estoque $estoque){
        $dataForm = $request->except('_token');
        
        $lista = $estoque->search($dataForm, $this->totalPage);
        
        return view('estoque.estoque', compact('lista','dataForm'));
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
        
    }

    public function form(){
        $lista_categoria = Categoria::all();

        return view('estoque.cadform',compact('lista_categoria'));
    }

  
    public function store(Request $request, Estoque $estoque)
    {
        $request->validate([
            'nome_produto' => 'required | max:255',
            'categoria_id' => 'required | numeric',
            'qtd_estoque' => 'required | numeric | min:1 | max:255',
            'valor'=> 'required | numeric | min:1 | max:255',    
        ]);

        $estoque->nome_produto = $request->nome_produto;
        $estoque->categoria_id = $request->categoria_id;
        $estoque->qtd_estoque = $request->qtd_estoque;
        $estoque->valor = $request->valor;

        $data = $estoque->save();

        if($data)
            return redirect() 
                ->back()
                ->with('success',  'Cadastro efetuado com sucesso!');

            return redirect()
                ->back()
                ->with('error',['message' => 'Falha ao carregar']);
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

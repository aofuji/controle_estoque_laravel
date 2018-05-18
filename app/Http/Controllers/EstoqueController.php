<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Categoria;
use App\Models\Estoque;
use App\Models\Historico;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class EstoqueController extends Controller
{
    private $totalPage = 7;
   
    public function index()
    {
        $lista_cliente = Cliente::all();

        $lista = DB::table('estoque')
        ->leftJoin('categorias', 'categorias.id', '=', 'estoque.categoria_id')
        ->select('estoque.*', 'categorias.categoria')
        ->orderby('estoque.id','desc')
        ->paginate($this->totalPage);
        
        return view('estoque.estoque', compact('lista', 'lista_cliente'));
    }

    public function searchEstoque(Request $request, Estoque $estoque){
        $lista_cliente = Cliente::all();
        $dataForm = $request->except('_token');
        $lista = $estoque->search($dataForm, $this->totalPage);
        
        return view('estoque.estoque', compact('lista','lista_cliente','dataForm'));
    }


    public function create()
    {
        
    }

    public function entrada(Request $request, $id){

        $request->validate([
            'quantidade' => 'required | numeric ',
        ]);

        $entrada = Estoque::find($id);
        $entrada->qtd_estoque = $entrada->qtd_estoque + $request->quantidade;

        $data = $entrada->save();
        
        if($data)
            Historico::create(
                ['tipo' => 'Entrada',
                'qtd' => $request->quantidade,
                'valor' => $entrada->valor,
                'usuario' => Auth::user()->name,
                'cliente' => 'nenhum',
                'obs' => 'teste',
                'estoque_id' => $entrada->id
                ]);
            return redirect() 
                ->back()
                ->with('success',  'Entrada efetuado com sucesso!');

            return redirect()
                ->back()
                ->with('error',['message' => 'Falha ao carregar']);
    }

    public function saida(Request $request, $id){
       
        $saida = Estoque::find($id);
        
            $saida->qtd_estoque = $saida->qtd_estoque - $request->qtd_saida;

            $data = $saida->save();
    
            if($data)
                Historico::create(
                    ['tipo' => 'Saida',
                    'qtd' => $request->qtd_saida,
                    'valor' => $saida->valor ,
                    'usuario' => Auth::user()->name,
                    'cliente' => $request->cliente,
                    'obs' => 'teste',
                    'estoque_id' => $saida->id
                    ]);
                return redirect() 
                    ->back()
                    ->with('success',  'Saida efetuado com sucesso!');
    
                return redirect()
                    ->back()
                    ->with('error',['message' => 'Falha ao carregar']);
    }

    public function form(){
        $lista_categoria = Categoria::all();

        return view('estoque.cadform',compact('lista_categoria'));
    }

  
    public function store(Request $request, Estoque $estoque)
    {
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';
        
        $request->validate([
            'nome_produto' => 'required | max:255',
            'codigo_produto'=> 'required| max:255',
            'categoria_id' => 'required | numeric',
            'qtd_estoque' => 'required | numeric | min:1 | max:255',
            'valor'=> 'required  ',    
        ]);
        
        $estoque->codigo_produto = $request->codigo_produto;
        $estoque->nome_produto = $request->nome_produto;
        $estoque->categoria_id = $request->categoria_id;
        $estoque->qtd_estoque = $request->qtd_estoque;
        $estoque->data = $dt;
        $estoque->valor = str_replace(",",".", $request->valor);

        $data = $estoque->save();

        if($data)
            return redirect() 
                ->back()
                ->with('success',  'Cadastro efetuado com sucesso!');

            return redirect()
                ->back()
                ->with('error',['message' => 'Falha ao carregar']);
    }

  
    public function show($id)
    {
        $list = Estoque::find($id);
        return response()->json($list);
    }

 
    public function edit($id)
    {
        $estoque = Estoque::find($id);
        $categoria = Categoria::all(['categoria','id']);

        return view('estoque.editform', compact('estoque','categoria'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_produto' => 'required | max:255',
            'codigo_produto'=> 'required| max:255',
            'categoria_id' => 'required | numeric',
            'qtd_estoque' => 'required ',
            'valor'=> 'required ',    
        ]);

        $estoque = Estoque::find($id);
        $estoque->codigo_produto = $request->codigo_produto;
        $estoque->nome_produto = $request->nome_produto;
        $estoque->categoria_id = $request->categoria_id;
        $estoque->qtd_estoque = $request->qtd_estoque;
        $estoque->valor = str_replace(",",".", $request->valor);

        $data = $estoque->save();
        if($data)
            return redirect() 
                    ->back()
                    ->with('success',  'Atualizado com Sucesso!');
            return redirect()
                    ->back()
                    ->with('error',['message' => 'Falha ao atualizar']);
    }

   
    public function destroy($id)
    {
        $estoque = Estoque::find($id);
        $data = $estoque->delete();
        return redirect()
                        ->back()
                        ->with('success',  'Sucesso ao Deletar');
    }
}

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
use Illuminate\Support\Facades\Redirect;


class EstoqueController extends Controller
{
    private $totalPage = 12;
    private $testeform;
    
    public function index()
    {
       

        $lista = DB::table('estoque')
        ->leftJoin('categorias', 'categorias.id', '=', 'estoque.categoria_id')
        ->select('estoque.*', 'categorias.categoria')
        ->orderby('estoque.id','desc')
        ->paginate($this->totalPage);
        
        $contador = count($lista);

        return view('estoque.estoque', compact('lista', 'contador'));
    }

    public function searchEstoque(Request $request, Estoque $estoque){
       
        $dataForm = $request->except('_token');
        $lista = $estoque->search($dataForm, $this->totalPage);
        $this->testeform = $dataForm;

        $contador = count($lista);
        return view('estoque.estoque', compact('lista','dataForm','contador'));
    }


    public function entradaForm($id){
        $item = Estoque::find($id);
        $historico = DB::table('historicos')
        ->where(function ($query) use ($id) {
            if(isset($id))
                $query->where('estoque_id', $id);
            
                $query->where('tipo', 'Entrada');
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                  ->select('historicos.*', 'clientes.nome')
                  ->orderby('historicos.id','desc')
                  ->limit(7)
                  ->get();
       
        $contador = count($historico);

        return view('estoque.entradaForm', compact('item','historico','contador'));
    }

    public function entrada(Request $request, $id, Estoque $estoque){
        
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        $request->validate([
            'qtd_entrada' => 'required | numeric ',
        ]);
       // $lista_cliente = Cliente::all();
       // $dataForm = $request->except('_token');
       // $lista = $estoque->search($dataForm, $this->totalPage);

        $entrada = Estoque::find($id);
        
        $entrada->qtd_estoque = $entrada->qtd_estoque + $request->qtd_entrada;

        $data = $entrada->save();
        
        if($data)
            Historico::create(
                ['tipo' => 'Entrada',
                'qtd' => $request->qtd_entrada,
                'valor_unitario' => $entrada->valor ,
                'valor_total' => $request->qtd_entrada * $entrada->valor,
                'usuario' => Auth::user()->name,
                'cliente_id' => null,
                'obs' => 'teste',
                'estoque_id' => $entrada->id,
                'created_at' => $dt
                ]);
          
            return redirect() 
                ->back() 
                ->with('success',  'Entrada efetuado com sucesso!');
                
                    
            return redirect()
                ->back()
                ->with('error',['message' => 'Falha ao carregar']);
    }

    public function saidaForm($id){
        $lista_cliente = Cliente::all()->reverse();
        $item = Estoque::find($id);
        $historico = DB::table('historicos')
        ->where(function ($query) use ($id) {
            if(isset($id))
                $query->where('estoque_id', $id);
            
                $query->where('tipo', 'Saida');
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                  ->select('historicos.*', 'clientes.nome')
                  ->orderby('historicos.id','desc')
                  ->limit(7)
                  ->get();
       
        $contador = count($historico);
       
        return view('estoque.saidaForm', compact('item','lista_cliente','historico','contador'));
    }

    public function saida(Request $request, $id){
       
        $saida = Estoque::find($id);
        
            $saida->qtd_estoque = $saida->qtd_estoque - $request->qtd_saida;

            $data = $saida->save();
    
            if($data)
                Historico::create(
                    ['tipo' => 'Saida',
                    'qtd' => $request->qtd_saida,
                    'valor_unitario' => $saida->valor ,
                    'valor_total' => $request->qtd_saida * $saida->valor,
                    'usuario' => Auth::user()->name,
                    'cliente_id' => $request->cliente,
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

    public function historicoView($id, Request $request){
        $idestoque = $id;
        $historico = DB::table('historicos')
        ->where(function ($query) use ($id, $request) {
            if(isset($id))
                $query->where('estoque_id', $id);
            if(isset($request['tipo']))
                $query->where('tipo', $request['tipo']);
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                  ->select('historicos.*', 'clientes.nome')
                  ->orderby('historicos.id','desc')
                  ->paginate(9);
                  
        $contador = count($historico);
        $produto = Estoque::find($id);

        return view('estoque.historico', compact('historico','contador','produto'))
        ->with(['idestoque' => $idestoque]);
    }

     public function historicoSearch($id, Request $request){
        $request->except('_token');
        
        $idestoque = $id;
        
        $historico = DB::table('historicos')
        ->where(function ($query) use ($id, $request) {
            $request->except('_token');
            if(isset($id))
                $query->where('estoque_id', $id);
            if($request->tipo != null)
                 $query->where('tipo', $request->tipo);
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                  ->select('historicos.*', 'clientes.nome')
                  ->orderby('historicos.id','desc')
                  ->paginate(9);
                  
        $contador = count($historico);
        $produto = Estoque::find($id);

        return view('estoque.historico', compact('historico','contador','produto'))
        ->with(['idestoque' => $idestoque]);
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

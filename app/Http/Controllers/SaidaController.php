<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Saida;
use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SaidaController extends Controller
{
    private $totalPage = 7;
    public function index()
    {
        $produtos = Produto::all();

        $list_saida = DB::table('saida_produtos')
        ->leftJoin('produtos', 'produtos.id', '=', 'saida_produtos.produto_id')
        ->select('saida_produtos.*', 'produtos.nome_produto')
        ->orderby('saida_produtos.id','desc')
        ->paginate($this->totalPage);
        
    
       return view('saida', compact('list_saida','produtos'));
    }

    public function searchSaida(Request $request, Saida $saida){

        $produtos = Produto::all();
        
        $dataForm = $request->except('_token');

        
        $list_saida = $saida->search($dataForm, $this->totalPage);
        
        return view('saida', compact('list_saida','produtos','dataForm'));
    }

    public function create()
    {
       
    }

    public function store(Request $request, Saida $saida, Estoque $estoque)
    {
       

        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        $saida->qtd_saida = $request->qtd_saida;
        $saida->valor = str_replace(",",".", $request->valor);
        $saida->produto_id = $request->nome_produto;
        $saida->created_at = $dt;
        $saida->updated_at = $dt;
        $data = $saida->save();

        $estoqueAtl = Estoque::where('produto_id', $request->nome_produto)
        ->get();
        
        $update = Estoque::updateOrCreate(['produto_id'=> $request->nome_produto],
                [
                 'qtd_estoque'=> $estoqueAtl ? $request->qtd_saida : $estoqueAtl[0]->qtd_estoque - $request->qtd_saida ,
                 'valor' => str_replace(",",".", $request->valor),
                 'produto_id ' => $request->nome_produto,
                 'data_saida' => $dt
                ]);
       
       

        if($data)
            return redirect()
                        ->back()
                        ->with('success',  'Sucesso ao cadastrar');
        }

    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $edit = Saida::find($id);

        return response()->json($edit);
    }

  
    public function update(Request $request, $id)
    {
        
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        $update = Saida::find($id);

        $update->qtd_saida = $request->qtd_saida;
        $update->valor = str_replace(",",".", $request->valor);
        $update->produto_id = $request->produto_id;
        $update->updated_at = $dt;

        $data = $update->save();
        if($data)
            return redirect()
                        ->back()
                        ->with('success',  'Sucesso ao Atualizar');
    }

   
    public function destroy($id)
    {
        $saida = Saida::find($id);
        $data = $saida->delete();
        return redirect()
                        ->back()
                        ->with('success',  'Sucesso ao Deletar');
    }
}

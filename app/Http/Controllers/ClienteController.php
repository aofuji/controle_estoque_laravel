<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    private $totalPage = 7;
   
    public function index()
    {
        $lista = DB::table('clientes')
        ->orderby('id','desc')
        ->paginate($this->totalPage);
       
       
        return view('cliente.cliente', compact('lista'));
    }

    public function searchCliente(Request $request, Cliente $cliente){
        $dataForm = $request->except('_token');
        $lista = $cliente->search($dataForm, $this->totalPage);
        
        return view('cliente.cliente', compact('lista','dataForm'));
    }

  
    public function create()
    {
        //
    }

    public function form(){
        return view('cliente.cadform');
    }
   
    public function store(Request $request, Cliente $cliente)
    {

        $request->validate([
            'nome' => 'required | max:255',
            'rg'=> 'required| numeric ',
            'cpf'=> 'required| numeric ',
            'endereco' => 'required | max:255',
            'cidade' => 'required | max:255',
            'estado' => 'required | max:255',
            'cep'=> 'required| numeric ',
            'telefone'=> 'required| numeric ',
            'celular'=> 'required| numeric ',
            'email'=> 'required| max:255',
            'data_nascimento'=> 'required', 
        ]);

        $cliente->nome = $request->nome;
        $cliente->rg = $request->rg;
        $cliente->cpf = $request->cpf;
        $cliente->endereco = $request->endereco;
        $cliente->cidade = $request->cidade;
        $cliente->estado = $request->estado;
        $cliente->cep = $request->cep;
        $cliente->telefone = $request->telefone;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->data_nascimento = $request->data_nascimento;

        $data = $cliente->save();
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
        $list = Cliente::find($id);
        return response()->json($list, 200);
    }

    
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.editform', compact('cliente'));
    }

   
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nome = $request->nome;
        $cliente->rg = $request->rg;
        $cliente->cpf = $request->cpf;
        $cliente->endereco = $request->endereco;
        $cliente->cidade = $request->cidade;
        $cliente->estado = $request->estado;
        $cliente->cep = $request->cep;
        $cliente->telefone = $request->telefone;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->data_nascimento = $request->data_nascimento;

        $data = $cliente->save();
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
        $cliente = Cliente::find($id);

        $data = $cliente->delete();
        return redirect()
            ->back()
            ->with('success',  'Sucesso ao Deletar');
    }
}
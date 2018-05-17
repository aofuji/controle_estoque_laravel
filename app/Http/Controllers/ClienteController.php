<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
   
    public function index()
    {
       $lista = Cliente::all();
        return view('cliente.cliente', compact('lista'));
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
        //
    }

    
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.editform', compact('cliente'));
    }

   
    public function update(Request $request, $id)
    {
        //
    }

 
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historico;
use Illuminate\Support\Facades\DB;

class HistoricoController extends Controller
{
    private $totalPage = 14;
    public function index()
    {
        //$historico = Historico::all();
        $historico = DB::table('historicos')
                ->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                ->leftJoin('estoque', 'estoque.id', '=', 'historicos.estoque_id')
                  ->select('historicos.*', 'clientes.nome', 'estoque.nome_produto')
                  ->orderby('historicos.id','desc')
                  ->paginate($this->totalPage);

        $contador = count($historico);
        
        return view('historico.historico', compact('historico'))->with('contador', $contador);
    }

   
    

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
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

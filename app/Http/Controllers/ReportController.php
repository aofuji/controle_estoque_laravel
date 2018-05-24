<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Models\Historico;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function historico($id,Request $request)
    {

        $historico = DB::table('historicos')
        ->where(function ($query) use ($id, $request) {

            if(isset($id))
                $query->where('estoque_id', $id);
            if($request->tipo != null)
                $query->where('tipo', $request->tipo);
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                ->leftJoin('estoque', 'estoque.id', '=', 'historicos.estoque_id')
                  ->select('historicos.*', 'clientes.nome','estoque.nome_produto')
                  ->orderby('historicos.id','desc')
                  ->get();

        $contador = count($historico);

        $valor_total = DB::table('historicos')
        ->where(function ($query) use ($id, $request) {

            if(isset($id))
                $query->where('estoque_id', $id);
            if($request->tipo != null)
                $query->where('tipo', $request->tipo);
                })    
                ->sum('valor_total');  

        $pdf = PDF::loadView('report.reportHistoryDetail',['historico' => $historico, 
                'contador'=> $contador,
                'valor_total'=> $valor_total ]);
                
        return $pdf->download('report_' . $request->tipo . '.pdf');
    }

    public function historicoall(Request $request){

        

        $historico = DB::table('historicos')
        ->where(function ($query) use ($request) {
            if($request->tipo != null)
                $query->where('tipo', $request->tipo);
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                ->leftJoin('estoque', 'estoque.id', '=', 'historicos.estoque_id')
                  ->select('historicos.*', 'clientes.nome','estoque.nome_produto')
                  ->orderby('historicos.id','desc')
                  ->get();
        
        $contador = count($historico);

        $valor_total = DB::table('historicos')
        ->where(function ($query) use ($request) {
            if($request->tipo != null)
                $query->where('tipo', $request->tipo);
                })    
                ->sum('valor_total');  

        $pdf = PDF::loadView('report.reportHistoryDetail',['historico' => $historico, 
                'contador'=> $contador,
                'valor_total'=> $valor_total ]);
                
        return $pdf->download('report_' . $request->tipo . '.pdf');
    }

    
    public function lista($id,Request $request)
    {
        //$lista = Historico::find(4)->cliente;
        //$historico = DB::table('historicos')
        //->where(function ($query) use ($id, $request) {
//
        //    if(isset($id))
        //        $query->where('estoque_id', $id);
        //    if(isset($request['tipo']))
        //        $query->where('tipo', $request['tipo']);
        //        })->Join('clientes', 'clientes.id', '=', 'historicos.cliente_id')
        //        ->Join('estoque', 'estoque.id', '=', 'historicos.estoque_id')
        //          ->select('historicos.*', 'clientes.nome', 'estoque.nome_produto'
        //          )
        //          ->groupBy('historicos.*', 'clientes.nome', 'estoque.nome_produto')
        //       
        //          ->get();
    //$historico = DB::table('historicos')->where('estoque_id',  $id)->sum('valor_unitario');     
    $historico = DB::table('historicos')
        ->where(function ($query) use ($id, $request) {

            if(isset($id))
                $query->where('estoque_id', $id);
            if(isset($request['tipo']))
                $query->where('tipo', $request['tipo']);
                })->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                ->leftJoin('estoque', 'estoque.id', '=', 'historicos.estoque_id')
                  ->select('historicos.*', 'clientes.nome','estoque.nome_produto')
                  ->orderby('historicos.id','desc')
                  ->get();
                 
        return response()->json($historico);
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

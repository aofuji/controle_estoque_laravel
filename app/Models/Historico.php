<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Historico extends Model
{
    protected $fillable =[
        'id',
        'tipo',
        'qtd',
        'valor_unitario',
        'valor_total',
        'cliente_id',
        'usuario',
        'obs',
        'estoque_id',
        'created_at',
        'updated_at'
    ];
    protected $table = 'historicos';

    public function search(Array $data, $totalPage){
        return DB::table('historicos')
            ->where(function ($query) use ($data) {
    
                if(isset($data['tipo']))
                    $query->where('tipo', $data['tipo']);
                if(isset($data['nome_produto']))
                    $query->where('nome_produto', $data['nome_produto']);
                if(isset($data['nome_cliente']))
                    $query->where('nome', $data['nome_cliente']);
                    })
                    ->leftJoin('clientes', 'clientes.id', '=', 'historicos.cliente_id')
                    ->leftJoin('estoque', 'estoque.id', '=', 'historicos.estoque_id')
                    ->select('historicos.*', 'clientes.nome', 'estoque.nome_produto')
                    ->orderby('historicos.id','desc')
                    ->paginate($totalPage);
         
     }

    public function estoque(){
        return $this->belongsTo(Estoque::class, 'estoque_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}



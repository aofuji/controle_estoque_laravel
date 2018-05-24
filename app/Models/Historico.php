<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function estoque(){
        return $this->belongsTo(Estoque::class, 'estoque_id');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}



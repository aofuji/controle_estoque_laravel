<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable =[
        'id',
        'tipo',
        'qtd',
        'valor',
        'created_at',
        'updated_at'
    ];
    protected $table = 'historicos';

    public function estoque(){
        return $this->hasMany(Estoque::class, 'historico_id');
    }
}



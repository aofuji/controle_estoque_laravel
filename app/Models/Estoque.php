<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['id','nome_produto','categoria_id','qtd_estoque','valor', 'data_entrada', 'data_saida'];
    protected $table = 'estoque';

    
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function historico(){
        return $this->hasMany(Historico::class, 'estoque_id');
    }
}

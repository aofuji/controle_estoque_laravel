<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['id', 'status', 'nome_produto', 'categoria_id'];

    protected $table = 'produtos';

    public function entrada(){
        return $this->hasMany(Entrada::class, 'produto_id');
    }

    public function saida(){
        return $this->hasMany(Saida::class, 'produto_id');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

}

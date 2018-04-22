<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['id', 'status', 'nome_produto'];

    protected $table = 'produtos';

    public function entrada(){
        return $this->hasMany(Entrada::class, 'produto_id');
    }

    public function saida(){
        return $this->hasMany(Saida::class, 'produto_id');
    }

    public function estoque(){
        return $this->hasMany(Estoque::class, 'produto_id');
    }

}

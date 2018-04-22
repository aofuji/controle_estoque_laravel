<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = [
        'id', 
        'qtd_estoque', 
        'valor', 
        'produto_id'
    ];

    protected $table = 'estoque';

    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}

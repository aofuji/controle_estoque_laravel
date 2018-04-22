<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = [
        'id',
        'qtd_entrada',
        'valor',
        'produto_id'
    ];

    protected $table = 'entrada_produtos';

    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }

}

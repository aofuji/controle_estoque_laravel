<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model
{
    protected $fillable = [
        'id',
        'qtd_saida',
        'valor',
        'produto_id'
    ];

    protected $table = 'saida_produtos';
    
    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }
}

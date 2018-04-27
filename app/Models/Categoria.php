<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable =[
        'id',
        'categoria'
    ];

    protected $table = 'categorias';

    public function produto(){
        return $this->hasMany(Produto::class, 'categoria_id');
    }

}

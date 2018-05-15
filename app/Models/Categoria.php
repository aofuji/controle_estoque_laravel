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

        public function estoque(){
            return $this->hasMany(Estoque::class, 'categoria_id');
        }

}

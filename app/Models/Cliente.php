<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'rg',
        'cpf',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'telefone',
        'celular',
        'email',
        'data_nascimento',
    ];

    protected $table = 'clientes';

    public function search(Array $data, $totalPage){
        return DB::table('clientes')
            ->where(function ($query) use ($data) {
    
                if(isset($data['nome']))
                    $query->where('nome', $data['nome']);
                  
                    })
                    ->orderby('id','desc')
                    ->paginate($totalPage);
         
     }
}

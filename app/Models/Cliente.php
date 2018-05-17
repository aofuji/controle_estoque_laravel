<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

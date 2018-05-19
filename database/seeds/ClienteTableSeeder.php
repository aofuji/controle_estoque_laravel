<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClienteTableSeeder extends Seeder
{
    

    public function run()
    {
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        DB::table('clientes')->insert([
            'nome' => 'Rafael da Silva',
            'rg' => 403289440,
            'cpf' => 42440657093,
            'endereco' => 'Rua Maceio, 243 - São Bento',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735002266',
            'celular'=> '01799994444',
            'email'=> 'rafael@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
    }
}

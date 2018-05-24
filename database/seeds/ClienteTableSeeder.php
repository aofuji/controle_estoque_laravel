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
        DB::table('clientes')->insert([
            'nome' => 'Wagner Morais de Souza',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Pamela Romero de Souza',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Wanessa de Paula',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Paulo Silva Castro',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Giovanna Romana',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Ricardo Otsuka',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Felipe Rodrigues Lopes',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Fatima Gladwoski',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Roberto Vildeski',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Jaqueline Morgano Lopez',
            'rg' => 403289340,
            'cpf' => 42440627093,
            'endereco' => 'Rua Manaus, 2432 - Centro',
            'cidade' => 'Catanduva',
            'estado' => 'SP',
            'cep'=>'15800000',
            'telefone'=> '01735001266',
            'celular'=> '01799992444',
            'email'=> 'wagnerl@teste.com',
            'data_nascimento'=> '1987-11-12',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
    }
}

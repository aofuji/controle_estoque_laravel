<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EstoqueTableSeeder extends Seeder
{
    
    public function run()
    {
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54443B22C1',
            'nome_produto' => 'Caneca',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AB54443B22C1',
            'nome_produto' => 'Agulha',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA44443B22C1',
            'nome_produto' => 'Papel',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54443B22C1',
            'nome_produto' => 'Copo Plastico',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54443I22C1',
            'nome_produto' => 'Colchao',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54943B22C1',
            'nome_produto' => 'Monitor',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54443B20C1',
            'nome_produto' => 'Teclado',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54443B200C1',
            'nome_produto' => 'HD',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54773B22C1',
            'nome_produto' => 'Mouse',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA5444PP22C1',
            'nome_produto' => 'Fone de Ouvido',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA54UU3B22C1',
            'nome_produto' => 'Smartphone',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('estoque')->insert([
            'codigo_produto' => 'AA5444KK22C1',
            'nome_produto' => 'Lampada',
            'qtd_estoque' => 20,
            'preco_custo' => 1.99,
            'preco_venda' => 4.00,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
    }
}

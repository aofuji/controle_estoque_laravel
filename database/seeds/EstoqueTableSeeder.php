<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EstoqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dt = Carbon::now();
        $dt->timezone = 'America/Sao_Paulo';

        DB::table('estoque')->insert([
            'codigo_produto' => '555444332221',
            'nome_produto' => 'Caneca',
            'qtd_estoque' => 20,
            'valor' => 1.99,
            'data' => $dt,
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
    }
}

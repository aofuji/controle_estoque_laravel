<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdutosTableSeeder extends Seeder
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

        DB::table('produtos')->insert([
            'status' => 1,
            'nome_produto' => 'Estojo',
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('produtos')->insert([
            'status' => 1,
            'nome_produto' => 'Lapis',
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('produtos')->insert([
            'status' => 1,
            'nome_produto' => 'Tesoura',
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('produtos')->insert([
            'status' => 1,
            'nome_produto' => 'Caneta',
            'categoria_id' => 1,
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
    }
}

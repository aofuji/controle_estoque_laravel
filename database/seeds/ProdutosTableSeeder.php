<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'status' => 1,
            'nome_produto' => 'Estojo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('produtos')->insert([
            'status' => 1,
            'nome_produto' => 'Lapis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

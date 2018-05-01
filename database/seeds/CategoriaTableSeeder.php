<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriaTableSeeder extends Seeder
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

        DB::table('categorias')->insert([
            'categoria' => 'Categoria1',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('categorias')->insert([
            'categoria' => 'Categoria2',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('categorias')->insert([
            'categoria' => 'Categoria3',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('categorias')->insert([
            'categoria' => 'Categoria4',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
        DB::table('categorias')->insert([
            'categoria' => 'Categoria5',
            'created_at' => $dt,
            'updated_at' => $dt,
        ]);
    }
}

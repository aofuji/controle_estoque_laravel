<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estoque extends Model
{
    protected $fillable = ['id','nome_produto','categoria_id','qtd_estoque','valor', 'data_entrada', 'data_saida'];
    protected $table = 'estoque';

    
    public function search(Array $data, $totalPage){
        return DB::table('estoque')
            ->where(function ($query) use ($data) {
    
                if(isset($data['nome_produto']))
                    $query->where('nome_produto','like', '%'. $data['nome_produto'] .'%');
                    
                if(isset($data['qtd_estoque']))
                    $query->where('qtd_estoque', $data['qtd_estoque']); 
                
                 
                    })
                    ->leftJoin('categorias', 'categorias.id', '=', 'estoque.categoria_id')
                    ->select('estoque.*', 'categorias.categoria')
                    ->orderby('estoque.id','desc')
                    ->paginate($totalPage);
         
     }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    
    public function historico(){
        return $this->hasMany(Historico::class, 'estoque_id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Saida extends Model
{
    protected $fillable = [
        'id',
        'qtd_saida',
        'valor',
        'produto_id'
    ];

    protected $table = 'saida_produtos';
    
    public function produto(){
        return $this->belongsTo(Produto::class, 'produto_id');
    }

    public function search(Array $data, $totalPage){
        return DB::table('saida_produtos')
            ->where(function ($query) use ($data) {
    
                if(isset($data['nome_produto']))
                    $query->where('nome_produto', $data['nome_produto']);
                if(isset($data['qtd_saida']))
                    $query->where('qtd_saida', $data['qtd_saida']); 
                   
                    })
                    ->leftJoin('produtos', 'produtos.id', '=', 'saida_produtos.produto_id')
                    ->select('saida_produtos.*', 'produtos.nome_produto')
                    ->orderby('saida_produtos.id','desc')
                ->paginate($totalPage);
         
     }
}

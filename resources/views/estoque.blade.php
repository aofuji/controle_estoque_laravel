@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Estoque</h1>
        </div>
    </div>
    <div class="row">
        <tabela-estoque url="estoque/lista" titulo="Estoque produtos" csstamanho="col-lg-12" 
        v-bind:titulotabela = "['#','Nome Produto', 'Categoria','Status', 'Qtd Rg Entrada','Qtd Rg Saida', 'Qtd Entrada', 'Qtd Saida', 'Total']">
        
        </tabela-estoque>
    </div>

    
</div>

@endsection

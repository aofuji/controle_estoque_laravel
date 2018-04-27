@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Estoque</h1>
        </div>
    </div>
   
    <div class="row">
           <tabela-entrada url="entrada/lista" titulo="Entrada" csstamanho="col-lg-6" 
        v-bind:titulotabela = "['#','Nome Produto', 'Valor','Quantidade']"></tabela-entrada>

            <tabela-saida url="saida/lista" titulo="Saida" csstamanho="col-lg-6" 
        v-bind:titulotabela = "['#','Nome Produto', 'Valor','Quantidade']"></tabela-saida>

    </div>
    <div class="row">
        <tabela url="produto" titulo="Estoque produtos" csstamanho="col-lg-12" 
        v-bind:titulotabela = "['#','Nome Produto', 'Categoria','Status', 'Qtd Rg Entrada','Qtd Rg Saida', 'Qtd Entrada', 'Qtd Saida', 'Total']">
        
        </tabela>
    </div>

    
</div>

@endsection

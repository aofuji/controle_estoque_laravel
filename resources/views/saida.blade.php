@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Saida</h1>
        </div>
    </div>
    <div class="row" teste2="testede propriedade">           
  
        <tabela-saida url="saida/lista" titulo="Saida" csstamanho="col-lg-12" 
            v-bind:titulotabela = "['#','Nome Produto', 'Valor','Quantidade', 'Ação']"></tabela-saida>
    </div>
</div>

@endsection

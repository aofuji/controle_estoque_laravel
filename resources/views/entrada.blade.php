@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Entrada</h1>
        </div>
    </div>
    
    <div class="row">
        <tabela-entrada url="entrada/lista"  csstamanho="col-lg-12" 
            v-bind:titulotabela = "['#','Nome Produto', 'Valor','Quantidade', 'Ação']"></tabela-entrada>
    </div>
</div>


@endsection

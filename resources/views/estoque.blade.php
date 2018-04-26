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
<modal nome="modalEstoque">
    <painel titulo="Cadastro">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </painel>
</modal>
@endsection

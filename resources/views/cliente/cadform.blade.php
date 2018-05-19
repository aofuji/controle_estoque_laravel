@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cadastro de cliente</h1>
        </div>
    </div>

    <div class="row">
    @include('includes.alerts')
    <form action="{{route('cliente.store')}}" method="post">
        {!! csrf_field()  !!}
        <div class="form-row">
        <div class="form-group col-md-12">
                <label for="">Nome</label>
                <input type="text" class="form-control" name="nome" placeholder="Digite Nome Completo">
            </div>
            
        </div>
 
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="">RG</label>
                <input type="text" class="form-control" name="rg" maxlength="9" placeholder="Digite RG sem ponto sem traço." required>
            </div>
            <div class="form-group col-md-5">
                <label for="">CPF</label>
                <input type="text" class="form-control" name="cpf" maxlength="11" placeholder="Digite CPF sem ponto sem traco">
            </div>
            <div class="form-group col-md-2">
                <label for="">Data Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" placeholder="Digite Data Nascimento">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="">Endereco</label>
                <input type="text" class="form-control" name="endereco" placeholder="Digite Endereço">
            </div>
            <div class="form-group col-md-2">
                <label for="">Cidade</label>
                <input type="text" class="form-control" name="cidade" placeholder="Digite Cidade">
            </div>
            <div class="form-group col-md-1">
                <label for="">Estado</label>
                <input type="text" class="form-control" name="estado" placeholder="Digite Estado">
            </div>
            <div class="form-group col-md-1">
                <label for="">Cep</label>
                <input type="text" class="form-control" name="cep" placeholder="Digite CEP">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="">Telefone</label>
                <input type="text" class="form-control" name="telefone" placeholder="Digite Telefone">
            </div>
            <div class="form-group col-md-4">
                <label for="">Celular</label>
                <input type="text" class="form-control" name="celular" placeholder="Digite Celular">
            </div>
            <div class="form-group col-md-4">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Digite Email">
            </div>
            
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('cliente') }}" class="btn">Voltar</a>
        </div>
        </form>
    </div>
</div>
@endsection
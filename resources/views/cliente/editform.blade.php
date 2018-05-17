@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edição</h1>
        </div>
    </div>

    <div class="row">
    @include('includes.alerts')
    <form action="" method="post">
        {!! csrf_field()  !!}
        <div class="form-row">
        <div class="form-group col-md-12">
                <label for="">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{$cliente->nome}}">
            </div>
            
        </div>
 
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="">RG</label>
                <input type="text" class="form-control" name="rg" value="{{$cliente->rg}}">
            </div>
            <div class="form-group col-md-5">
                <label for="">CPF</label>
                <input type="text" class="form-control" name="cpf" value="{{$cliente->cpf}}">
            </div>
            <div class="form-group col-md-2">
                <label for="">Data Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" value="{{$cliente->data_nascimento}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="">Endereco</label>
                <input type="text" class="form-control" name="endereco" value="{{$cliente->endereco}}">
            </div>
            <div class="form-group col-md-2">
                <label for="">Cidade</label>
                <input type="text" class="form-control" name="cidade" value="{{$cliente->cidade}}">
            </div>
            <div class="form-group col-md-1">
                <label for="">Estado</label>
                <input type="text" class="form-control" name="estado" value="{{$cliente->estado}}">
            </div>
            <div class="form-group col-md-1">
                <label for="">Cep</label>
                <input type="text" class="form-control" name="cep" value="{{$cliente->cep}}">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="">Telefone</label>
                <input type="text" class="form-control" name="telefone" value="{{$cliente->telefone}}">
            </div>
            <div class="form-group col-md-4">
                <label for="">Celular</label>
                <input type="text" class="form-control" name="celular" value="{{$cliente->celular}}">
            </div>
            <div class="form-group col-md-4">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" value="{{$cliente->email}}">
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
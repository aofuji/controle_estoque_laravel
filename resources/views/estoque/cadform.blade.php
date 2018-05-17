@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cadastro</h1>
        </div>
    </div>

    <div class="row">
    @include('includes.alerts')
    <form action="{{ route('form.store') }}" method="post">
        {!! csrf_field()  !!}
        <div class="form-row">
        <div class="form-group col-md-2">
                <label for="inputEmail4">Cod. Produto</label>
                <input type="text" class="form-control" name="codigo_produto" placeholder="Digite codigo....">
            </div>
            <div class="form-group col-md-5">
                <label for="inputEmail4">Nome Produto</label>
                <input type="text" class="form-control" name="nome_produto" placeholder="Digite Nome do Produto....">
            </div>
            <div class="form-group col-md-5">
            <label for="inputState">Categoria</label>
            <select  class="form-control" name="categoria_id">
                <option selected>Selecione Categoria</option>
                @foreach ($lista_categoria as $item)
                <option value="{{$item->id}}">{{$item->categoria}}</option>
                @endforeach
            </select>
            </div>
        </div>
 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Quantidade</label>
                <input type="text" class="form-control" name="qtd_estoque" placeholder="Digite quantidade....">
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">Valor</label>
                <input type="text" class="form-control" name="valor" placeholder="Digite valor....">
            </div>
            
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="{{ route('estoque') }}" class="btn">Voltar</a>
        </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Entrada</h1>
                </div>
            </div>
            <div class="row">
                @include('includes.alerts')
                <form action="{{route('estoque.entrada',$item->id)}}" method="post">
                        {!! csrf_field()  !!}
                    
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Codigo do Produto</label> 
                        <input type="text" class="form-control" value="{{$item->codigo_produto}}" disabled>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Nome</label>
                            <input type="text" class="form-control" value="{{$item->nome_produto}}" disabled>
                            <input  type="hidden" name="nome_produto" value="">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Quantidade</label>
                            <input type="text" class="form-control" value="{{$item->qtd_estoque}}" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Valor</label>
                            <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" class="form-control" value="{{number_format($item->valor, 2, ',', '.')}}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Entrada</label>
                            <input type="number" min="1"  class="form-control" name="qtd_entrada" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary ">Cadastrar</button>
                            <a href="{{ route('estoque') }}" class="btn">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
</div>
@endsection
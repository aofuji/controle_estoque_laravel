@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Editar</h1>
        </div>
    </div>
    
    <div class="row">
    @include('includes.alerts')
    {!! Form::model($estoque, ['method' => 'POST','route' => ['estoque.update', $estoque->id],'files'=>'true']) !!}
        {!! csrf_field()  !!}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">Cod. Produto</label>
                {!! Form::text('codigo_produto', null, array('placeholder' => 'Digite codigo do produto....','class' => 'form-control')) !!}    
            </div>
            <div class="form-group col-md-5">
                <label for="inputEmail4">Nome Produto</label>
                {!! Form::text('nome_produto', null, array('placeholder' => 'Digite Nome do Produto....','class' => 'form-control')) !!}    
            </div>
            <div class="form-group col-md-5">
                <label for="">Categoria</label>
                {!! Form::select('categoria_id',$categoria->pluck('categoria','id'),null, array('class' => 'form-control')) !!}
            </div>
        </div>
 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Quantidade</label>
                {!! Form::text('qtd_estoque', null, array('placeholder' => 'Digite quantidade...','class' => 'form-control')) !!}
            </div>
            <div class="form-group col-md-6">
                <label for="">Valor</label>
                <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" name="valor" v-money="money" value="{{$estoque->valor}}" class="form-control" placeholder="Digite valor....">
                </div>
            </div>
            
        </div>
        <div class="form-group col-md-2">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{ route('estoque') }}" class="btn">Voltar</a>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
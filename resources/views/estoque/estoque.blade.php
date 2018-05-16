@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Estoque</h1>
        </div>
        
    </div>
    <div class="row">
    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">      
                                <a class="btn btn-primary btn-sm"  href="{{ route('form.estoque') }}" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">   
                                <form method="POST" class="form form-inline" action="{{ route('estoque.search') }}">
                                {!! csrf_field()  !!}
                                    <input type="text" name="nome_produto" class="form-control" placeholder="Pesquisar..">
                                    <input type="text" name="qtd_estoque" class="form-control" placeholder="Quantidade">

                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome Produto</th>
                                    <th>Categoria</th>
                                    <th>Quantidade</th>
                                    <th>valor</th>
                                   
                                    <th>Criado</th>
                                    <th>Atualizado</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                        @foreach ($lista as $item)
                            <tr >
                                <td>{{$item->id}}</td>
                                <td>{{$item->nome_produto}}</td>
                                <td>{{$item->categoria}}</td>
                                <td>{{$item->qtd_estoque}}</td>
                                <td>R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                               
                                <td>{{date('d/m/Y - H:i:s a', strtotime($item->created_at))}}</td>
                                <td>{{ date('d/m/Y - H:i:s a', strtotime($item->updated_at))}}</td>
                                <td>
                                    <button class="btn btn-success btn-sm"><i class="fa fa-sign-in" aria-hidden="true"></i></button>
                                    <button class="btn btn-info btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button> 
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                            <div class="text-center">
                                {!! $lista->links() !!}
                            </div>
                    </div>
                <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                    </div>
                <!-- /.panel -->
        </div>
    </div>

    
</div>

@endsection

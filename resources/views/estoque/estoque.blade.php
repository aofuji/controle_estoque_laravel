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
                            <div class="col-lg-2 col-md-6 col-sm-6">      
                                <a class="btn btn-primary btn-sm"  href="{{ route('form.estoque') }}" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12">   
                                <form method="POST" class="form form-inline" action="{{ route('estoque.search') }}">
                                {!! csrf_field()  !!}
                                    <input type="text" name="codigo_produto" class="form-control" placeholder="Digite codigo do produto">
                                    <input type="date" name="date" class="form-control" placeholder="Digite codigo do produto">
                                    <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">
                                    <input type="text" name="qtd_estoque" class="form-control" placeholder="Digite a quantidade">

                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    @include('includes.alerts')
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cod. Produto</th>
                                    <th>Nome Produto</th>
                                    <th>Categoria</th>
                                    <th>Quantidade</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                        @foreach ($lista as $item)
                            <tr >
                                <td>{{$item->id}}</td>
                                <td>{{$item->codigo_produto}}</td>
                                <td>{{$item->nome_produto}}</td>
                                <td>{{$item->categoria}}</td>
                                <td>{{$item->qtd_estoque}}</td>
                                <td>R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                                <td>{{date('d/m/Y', strtotime($item->data))}}</td>
                                <td>
                                    
                                    <buttonex modalnome="entrada" cssbtn="btn btn-success btn-sm" cssicon="fa fa-sign-in" url="estoque/show/" id="{{$item->id}}"></buttonex>
                                    <button class="btn btn-info btn-sm"><i class="fa fa-sign-out" aria-hidden="true"></i></button>
                                    <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <buttonex modalnome="saidaDelete" cssbtn="btn btn-danger btn-sm" cssicon="fa fa-trash-o" url="estoque/show/" id="{{$item->id}}"></buttonex>
                                    
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                            <div class="text-center">
                               
                                @if(isset($dataform))
                                {!! $lista->appends($dataForm)->links() !!}
                                @else
                                {!! $lista->links() !!}
                                @endif
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
<modal nome="saidaDelete" titulo="Excluir">
    <formulario token="{{ csrf_token() }}" v-bind:action="'estoque/delete/'+ $store.state.item.id" method="post">
        <h3>Deseja exluir esse produto ?</h3>
        <p><strong>Id:</strong> @{{$store.state.item.id}} </p>
        <p><strong>Cod. Produto:</strong> @{{$store.state.item.codigo_produto}} </p>
        <p><strong>Nome:</strong> @{{$store.state.item.nome_produto}}</p>
        <p><strong>Valor:</strong> @{{$store.state.item.valor}}</p>
        <p><strong>Quantidade:</strong> @{{$store.state.item.qtd_estoque}}</p>
    
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        </div>
    </formulario>
</modal>

<modal nome="entrada" titulo="Entrada">
    <formulario token="{{ csrf_token() }}" v-bind:action="'estoque/entrada/'+ $store.state.item.id" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                <label>Codigo do Produto</label> @{{$store.state.item.codigo_produto}}
            </div>
            <div class="form-group col-md-12">
                <label>Nome</label> @{{$store.state.item.nome_produto}}
            </div>
            <div class="form-group col-md-12">
                <label>Quantidade</label> @{{$store.state.item.qtd_estoque}}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <label>Entrada</label>
                <input type="number" min="1" max="99" class="form-control" name="quantidade" required>
                
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary ">Cadastrar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </formulario>
</modal>
@endsection

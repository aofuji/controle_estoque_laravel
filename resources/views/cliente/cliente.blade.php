@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Cliente</h1>
        </div>
        
    </div>
    <div class="row">
    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-sm-6">      
                                <a class="btn btn-primary btn-sm"  href="{{route('form.cliente')}}" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12">   
                                <form method="POST" class="form form-inline" action="">
                                {!! csrf_field()  !!}
                                    
                                    <input type="text" name="nome" class="form-control" placeholder="Digite Nome do Cliente">
                                  

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
                                    <th>Nome</th>
                                    <th>RG</th>
                                    <th>CPF</th>
                                    <th>Endereco</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Cep</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Data Nascimento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                        @foreach ($lista as $item)
                            <tr >
                                <td>{{$item->id}}</td>
                                <td>{{$item->nome}}</td>
                                <td>{{$item->rg}}</td>
                                <td>{{$item->cpf}}</td>
                                <td>{{$item->endereco}}</td>
                                <td>{{$item->cidade}}</td>
                                <td>{{$item->estado}}</td>
                                <td>{{$item->cep}}</td>
                                <td>{{$item->telefone}}</td>
                                <td>{{$item->celular}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{date('d/m/Y', strtotime($item->data_nascimento))}}</td>
                                
                                <td>
                                    
                                    <a href="{{route('cliente.edit', $item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <buttondelete modalnome="clienteDelete"  url="estoque/show/" idsaida="{{$item->id}}"></buttondelete> 
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                            <div class="text-center">
                               
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
<modal nome="clienteDelete" titulo="Excluir">
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
@endsection

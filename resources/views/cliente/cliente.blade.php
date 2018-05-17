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
                                <form method="POST" class="form form-inline" action="{{route('cliente.search')}}">
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
                                    <th>Endereco</th>
                                    <th>Cidade</th>
                                    <th>Estado</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                        @foreach ($lista as $item)
                            <tr >
                                <td>{{$item->id}}</td>
                                <td>{{$item->nome}}</td>
                                
                                <td>{{$item->endereco}}</td>
                                <td>{{$item->cidade}}</td>
                                <td>{{$item->estado}}</td>
                                <td>{{$item->telefone}}</td>
                                
                                <td>
                                    
                                    <buttonex modalnome="clienteView" cssbtn="btn btn-info btn-sm" cssicon="fa fa-eye" url="cliente/show/" id="{{$item->id}}"></buttonex> 
                                    <a href="{{route('cliente.edit', $item->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <buttonex modalnome="clienteDelete" cssbtn="btn btn-danger btn-sm" cssicon="fa fa-trash-o" url="cliente/show/" id="{{$item->id}}"></buttonex> 
                                    
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
<modal nome="clienteDelete" titulo="Excluir">
    <formulario token="{{ csrf_token() }}" v-bind:action="'cliente/delete/'+ $store.state.item.id" method="post">
        <h3>Deseja exluir esse Cliente ?</h3>
        <p><strong>Id:</strong> @{{$store.state.item.id}} </p>
        <p><strong>Nome:</strong> @{{$store.state.item.nome}} </p>
        
    
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        </div>
    </formulario>
</modal>

<modal nome="clienteView" titulo="Vizualização">

    <div class="row">
        <div class="form-group col-md-12">
                <label for="">Nome</label>
                <input type="text" class="form-control" name="nome" v-model="$store.state.item.nome" disabled>
        </div>
            
        </div>
 
        <div class="row">
            <div class="form-group col-md-4">
                <label for="">RG</label>
                <input type="text" class="form-control" name="rg" v-model="$store.state.item.rg" disabled>
            </div>
            <div class="form-group col-md-5">
                <label for="">CPF</label>
                <input type="text" class="form-control" name="cpf" v-model="$store.state.item.cpf" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="">Data Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" v-model="$store.state.item.data_nascimento" disabled>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Endereco</label>
                <input type="text" class="form-control" name="endereco" v-model="$store.state.item.endereco" disabled>
            </div>
            <div class="form-group col-md-2">
                <label for="">Cidade</label>
                <input type="text" class="form-control" name="cidade" v-model="$store.state.item.cidade" disabled>
            </div>
            <div class="form-group col-md-1">
                <label for="">Estado</label>
                <input type="text" class="form-control" name="estado" v-model="$store.state.item.estado" disabled>
            </div>
            <div class="form-group col-md-3">
                <label for="">Cep</label>
                <input type="text" class="form-control" name="cep" v-model="$store.state.item.cep" disabled>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="">Telefone</label>
                <input type="text" class="form-control" name="telefone" v-model="$store.state.item.telefone" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="">Celular</label>
                <input type="text" class="form-control" name="celular" v-model="$store.state.item.celular" disabled>
            </div>
            <div class="form-group col-md-4">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" v-model="$store.state.item.email" disabled>
            </div>
            
        </div>
        
</modal>
@endsection

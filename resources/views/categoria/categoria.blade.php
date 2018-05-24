@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Categoria</h1>
        </div>
        
    </div>
    <div class="row">
    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-sm-6">      
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cadCategoria"><i class="fa fa-plus" aria-hidden="true"></i></button>
                               
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
                                    <th>Categorias</th>                
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                        @foreach ($lista as $item)
                            <tr >
                                <td>{{$item->id}}</td>
                                <td>{{$item->categoria}}</td>
                                <td>
                                    <buttonex modalnome="categoriaEdit" cssbtn="btn btn-warning btn-sm" cssicon="fa fa-pencil" url="categoria/show/" id="{{$item->id}}"></buttonex>
                                    <buttonex modalnome="categoriaDelete" cssbtn="btn btn-danger btn-sm" cssicon="fa fa-trash-o" url="categoria/show/" id="{{$item->id}}"></buttonex>
                                </td>
                            </tr>
                        @endforeach

                        @if($contador == 0)
                             <tr>
                                <th scope="row"></th>
                                <th scope="row">Nenhum registro</th>
                                <td colspan="2"></td>
                            </tr>
                        @endif     
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
<modal nome="cadCategoria" titulo="Cadastrar">
    <formulario token="{{ csrf_token() }}" action="{{ route('categoria.store') }}" method="post">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Categoria</label> 
                <input type="text" class="form-control" name="categoria" >
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

<modal nome="categoriaDelete" titulo="Excluir">
    <formulario token="{{ csrf_token() }}" v-bind:action="'categoria/delete/'+ $store.state.item.id" method="post">
    <div class="row">
            <div class="col-md-12"> 
                <h3>Deseja exluir essa Categoria ?</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">               
                <strong>#ID</strong> @{{$store.state.item.id}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <dl>
                    <dt>Categoria</dt>
                    <dd>@{{$store.state.item.categoria}}</dd>
                </dl>
            </div>
            
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        </div>
    </formulario>
</modal>

<modal nome="categoriaEdit" titulo="Editar">
    <formulario token="{{ csrf_token() }}" v-bind:action="'categoria/edit/'+ $store.state.item.id" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                    <label for="">Categoria</label>
                    <input type="text" class="form-control" name="categoria" v-model="$store.state.item.categoria">
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        </div>
    </formulario>
</modal>

@endsection

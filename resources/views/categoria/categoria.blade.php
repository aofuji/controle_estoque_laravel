@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Categoria</h1>
            <br>
            @include('includes.alerts')
            
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
                <div class="panel">
                        <div class="panel-heading">
                            <a href="#" data-toggle="modal" data-target="#cadCategoria"><i class="fas fa-plus"></i> Adicionar</a>
                            &nbsp;
                            <a href="#" data-toggle="modal" data-target="#importar" ><i class="fas fa-upload"></i> Importar</a>
                        </div>
                        <div class="panel-body no-padding">
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
                                                <buttonex modalnome="categoriaEdit" cssbtn="btn btn-warning btn-sm" cssicon="fas fa-edit" url="categoria/show/" id="{{$item->id}}"></buttonex>
                                                <buttonex modalnome="categoriaDelete" cssbtn="btn btn-danger btn-sm" cssicon="fas fa-trash-alt" url="categoria/show/" id="{{$item->id}}"></buttonex>
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
                    <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
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
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
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
            <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Atualizar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
        </div>
    </formulario>
</modal>

<modal nome="importar" titulo="Importar">
<form action="{{ route('categoria.import') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="form-group col-md-12">
                    <label for="">Importe arquivo com extensão .xlsx</label>
                    <input type="file" class="form-control" name="file" autofocus required>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fas fa-upload" ></i> Importar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
        </div>
    </form>
</modal>
@endsection

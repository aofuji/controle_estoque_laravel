@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Clientes</h1>
            <br>
            @include('includes.alerts')
        </div>
    </div>

    <div class="row">
            <div class="col-lg-12">
                    <div class="panel">
                            <div class="panel-heading">
                                <a href="#" data-toggle="modal"  data-target="#cadastro" ><i class="fa fa-plus" ></i> Adicionar</a>

                                <div class="pull-right">   
                                    <form method="POST" class="form form-inline" action="{{route('cliente.search')}}">
                                    {!! csrf_field()  !!}
                                        <input type="text" name="nome" class="form-control" placeholder="Digite Nome do Cliente">
                                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search" ></i></button>
                                    </form>
                                </div>  
                            </div>
                            <div class="panel-body no-padding">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>Endereço</th>
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
                                                    <a href="{{route('cliente.edit', $item->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                                    <buttonex modalnome="clienteDelete" cssbtn="btn btn-danger btn-sm" cssicon="fas fa-trash-alt" url="cliente/show/" id="{{$item->id}}"></buttonex> 
                                                    
                                                </td>
                                            </tr>
                                        @endforeach 
                                        @if($contador == 0)
                                             <tr>
                                                <th scope="row"></th>
                                                <th scope="row">Nenhum registro</th>
                                                <td colspan="6"></td>
                                            </tr>
                                        @endif 
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
                        </div>
            </div>
        </div>

    


<modal nome="clienteDelete" titulo="Excluir">
    <formulario token="{{ csrf_token() }}" v-bind:action="'cliente/delete/'+ $store.state.item.id" method="post">
        <h3>Deseja exluir esse Cliente ?</h3>
        <p><strong>#Id:</strong> @{{$store.state.item.id}} </p>
        <p><strong>Nome:</strong> @{{$store.state.item.nome}} </p>
        
    
        <div class="form-group">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
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

<modal nome="cadastro" titulo="Cadastrar">
    <formulario token="{{ csrf_token() }}" action="{{ route('cliente.store') }}" method="post">
            
                    <div class="row">
                    <div class="form-group col-md-12">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="nome" placeholder="Digite Nome Completo" required>
                        </div>
                        
                    </div>
             
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="">RG</label>
                            <input type="text" class="form-control" name="rg" maxlength="9" placeholder="Digite RG sem ponto sem traço." required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">CPF</label>
                            <input type="text" class="form-control" name="cpf" maxlength="11" placeholder="Digite CPF sem ponto sem traco" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Data Nascimento</label>
                            <input type="date" class="form-control" name="data_nascimento" placeholder="Digite Data Nascimento" required>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Endereco</label>
                            <input type="text" class="form-control" name="endereco" placeholder="Digite Endereço" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Cidade</label>
                            <input type="text" class="form-control" name="cidade" placeholder="Digite Cidade" required>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="">Estado</label>
                            <input type="text" class="form-control" maxlength="2" name="estado" placeholder="UF" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="">Cep</label>
                            <input type="text" class="form-control" name="cep" placeholder="Digite CEP">
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">Telefone</label>
                            <input type="text" class="form-control" maxlength="11"  name="telefone" placeholder="Digite Telefone" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Celular</label>
                            <input type="text" class="form-control" maxlength="12" name="celular" placeholder="Digite Celular" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Digite Email" required>
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

@endsection

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            
            <br>
            @include('includes.alerts')         
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <a href="#" data-toggle="modal" data-target="#cadUser" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                </div>
                <div class="panel-body no-padding">
                        <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Nivel</th>
                                        <th>Criado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                            <tbody>
            
                            @foreach ($lista as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->nivel_acesso == 1? 'Administrador': 'Atendente'}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                         <buttonex modalnome="userEdit" cssbtn="btn btn-warning btn-sm" cssicon="fas fa-edit" url="user/show/" id="{{$item->id}}"></buttonex>
                                        <buttonex modalnome="userDelete" cssbtn="btn btn-danger btn-sm" cssicon="fas fa-trash-alt" url="user/show/" id="{{$item->id}}"></buttonex>
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
                </div>
            </div>
        </div>
    </div>


 <modal nome="cadUser" titulo="Cadastrar">
    <formulario token="{{ csrf_token() }}" action="{{ route('user.store') }}" method="post">
        <div class="row">
            <div class="col-md-12">
                <label>Nome</label>
                <input type="text" class="form-control" name="name" required>
                <label>email</label>
                <input type="email" class="form-control" name="email" required>
                <label>Senha</label>
                <input type="password" class="form-control" name="password" required>
                <label>Nivel</label>
                <select class="form-control" name="nivel_acesso" required="">
			      <option value="">selecione</option>
			      <option value="1">Administrador</option>
			      <option value="2">Atendente</option>

   			   </select>
            </div>
        </div>
        <br>
        <div class="row">
                <div class=" col-md-12">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                </div>
            </div>
    </formulario>
</modal>

<modal nome="userDelete" titulo="Excluir">
    <formulario token="{{ csrf_token() }}" v-bind:action="'user/delete/'+ $store.state.item.id" method="post">
    <div class="row">
            <div class="col-md-12">
                <h3>Deseja exluir esse Usuario ?</h3>
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
                    <dt>Email</dt>
                    <dd>@{{$store.state.item.email}}</dd>
                </dl>
            </div>

        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
        </div>
    </formulario>
</modal>

<modal nome="userEdit" titulo="Editar">
    <formulario token="{{ csrf_token() }}" v-bind:action="'user/edit/'+ $store.state.item.id" method="post">
        <div class="row">
            <div class="form-group col-md-12">
                    <label for="">Nome</label>
                    <input type="text" class="form-control" name="name" v-model="$store.state.item.name">
            </div>
            <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" v-model="$store.state.item.email">
            </div>
            <div class="form-group col-md-12">
            	 <label>Nivel</label>
	            <select class="form-control" name="nivel_acesso" required="">
				      <option  v-bind:value="$store.state.item.nivel_acesso == 1? 1:2">@{{$store.state.item.nivel_acesso == 1?'Administrador':'Atendente' }}</option>

				      <option  v-bind:value="$store.state.item.nivel_acesso != 1? 1:2">@{{$store.state.item.nivel_acesso != 1?'Administrador':'Atendente' }}</option>
	   			 </select>
	   			</div>
            <div class="form-group col-md-12">
                    <label for="">Senha</label>
                    <input type="password" class="form-control" name="password" placeholder="Nova senha">
            </div>
        </div>

        <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Atualizar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
        </div>
    </formulario>
</modal>

@endsection

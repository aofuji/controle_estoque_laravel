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
                                <a class="btn btn-primary "  href="{{ route('form.estoque') }}" ><i class="fa fa-plus" aria-hidden="true"> </i></a>
                            </div>
                            <div class="col-lg-10 col-md-12 col-sm-12">   
                                <form method="POST" class="form form-inline" action="{{ route('estoque.search') }}">
                                {!! csrf_field()  !!}
                                    <input type="text" name="codigo_produto" class="form-control" placeholder="Digite codigo do produto">
                                    <input type="date" name="date" class="form-control" placeholder="Digite codigo do produto">
                                    <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">
                                    <input type="text" name="qtd_estoque" class="form-control" placeholder="Digite a quantidade">

                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar</button>
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
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">{{$item->id}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">{{$item->codigo_produto}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">{{$item->nome_produto}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">{{$item->categoria}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">{{$item->qtd_estoque}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">{{date('d/m/Y', strtotime($item->data))}}</td>
                                <td class="{{$item->qtd_estoque == 0 ? "bg-danger": ''}}">

                                    
                                    <a href="{{ route('estoque.historicoview', $item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-history" aria-hidden="true"></i></a>
                                    <buttonex modalnome="entrada" cssbtn="btn btn-success btn-sm" cssicon="fa fa-sign-in" url="estoque/show/" id="{{$item->id}}"></buttonex>
                                    <buttonsaida modalnome="saida" validacao="{{$item->qtd_estoque}}" cssbtn="btn btn-info btn-sm" cssicon="fa fa-sign-out" url="estoque/show/" id="{{$item->id}}"></buttonsaida>
                                    
                                    <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <buttonex modalnome="saidaDelete" cssbtn="btn btn-danger btn-sm" cssicon="fa fa-trash-o" url="estoque/show/" id="{{$item->id}}"></buttonex>
                                    
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
        <div class="row">
            <div class="col-md-12"> 
                <h3>Deseja exluir esse produto ?</h3>
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
                    <dt>Nome</dt>
                    <dd>@{{$store.state.item.nome_produto}}</dd>
                    <dt>Quantidade</dt>
                    <dd>@{{$store.state.item.qtd_estoque}}</dd>
                </dl>
            </div>
            <div class="col-md-4">
                <dl>
                    <dt>Cod. Produto</dt>
                    <dd>@{{$store.state.item.codigo_produto}}</dd>
                    <dt>Valor</dt>
                    <dd>R$ @{{$store.state.item.valor}}</dd>
                </dl>
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        </div>
    </formulario>
</modal>

<modal nome="entrada" titulo="Entrada">
    <formulario token="{{ csrf_token() }}" v-bind:action="'estoque/entrada/'+ $store.state.item.id" method="post">
        <div class="row">
            <div class="form-group col-md-4">
                <label>Codigo do Produto</label> 
                <input type="text" class="form-control"  v-model="$store.state.item.codigo_produto" disabled>
            </div>
            <div class="form-group col-md-4">
                <label>Nome</label>
                <input type="text" class="form-control" v-model="$store.state.item.nome_produto" disabled>
                <input  type="hidden" name="nome_produto" v-bind:value="$store.state.item.nome_produto">
            </div>
            <div class="form-group col-md-2">
                <label>Quantidade</label>
                <input type="text" class="form-control"  v-model="$store.state.item.qtd_estoque" disabled>
            </div>
            <div class="form-group col-md-2">
                <label>Valor</label>
                
                <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" v-money="money" class="form-control" v-model="$store.state.item.valor" disabled>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </formulario>
</modal>

<modal nome="saida" titulo="Saida">
    
    <formulario token="{{ csrf_token() }}" v-bind:action="'estoque/saida/'+ $store.state.item.id" method="post">
        <div class="row">
                <div class="form-group col-md-4">
                    <label>Codigo do Produto</label> 
                    <input type="text" class="form-control"  v-model="$store.state.item.codigo_produto" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label>Nome</label>
                    <input type="text" class="form-control"  v-model="$store.state.item.nome_produto" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label>Quantidade</label>
                    <input type="text" class="form-control"  v-model="$store.state.item.qtd_estoque" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label>Valor</label>
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" v-money="money" class="form-control" v-model="$store.state.item.valor" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Cliente</label>
                    <select multiple class="form-control" name="cliente" required>                    
                        @foreach ($lista_cliente as $cliente)
                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @endforeach                   
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Saida</label>
                    <input type="number" min="1" v-bind:max="$store.state.item.qtd_estoque" class="form-control" name="qtd_saida" required>
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

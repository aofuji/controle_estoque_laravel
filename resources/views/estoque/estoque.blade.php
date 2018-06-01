@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Estoque</h1>
            <br>
            @include('includes.alerts')
        </div>
    </div>

    <div class="row">
            <div class="col-lg-12">
                    <div class="panel">
                            <div class="panel-heading">
                                    @if(Auth::user()->nivel_acesso == 1)
                                    <a href="#" data-toggle="modal"  data-target="#cadastro" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                                    @endif
                                    <div class="pull-right ">
                                        <form method="POST" class="form form-inline" action="{{ route('estoque.search') }}">
                                        {!! csrf_field()  !!}
                                            <input type="text" name="codigo_produto" class="form-control" placeholder="Digite codigo do produto">
                                            <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">
                    
                                            <input type="number" name="qtd_estoque" class="form-control" placeholder="Digite a quantidade">
                    
                                            <a type="submit" class="btn btn-primary form-control"><i class="fa fa-search" ></i></a>
                                        </form>
                                    </div>
                            </div>
                            <div class="panel-body no-padding">
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
                                            <tr  >
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">{{$item->id}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">{{$item->codigo_produto}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">{{$item->nome_produto}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">{{$item->categoria}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">{{$item->qtd_estoque}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">R$ {{number_format($item->valor, 2, ',', '.')}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">{{date('d/m/Y', strtotime($item->data))}}</td>
                                                <td class="{{$item->qtd_estoque == 0 ? "bg-row": ''}}">
                            
                            
                                                    <a href="{{ route('estoque.historicoview', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Historico"><i class="fa fa-history" aria-hidden="true"></i></a>
                                                    @if(Auth::user()->nivel_acesso == 1)
                                                         <a href="{{ route('estoque.entradaform', $item->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Entrada"><i class="fas fa-sign-in-alt"></i></a>
                                                    @endif
                            
                                                    @if($item->qtd_estoque != 0)
                                                        <a href="{{ route('estoque.saidaform', $item->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Saida"><i class="fas fa-sign-out-alt"></i></a>
                                                    @endif
                            
                                                    @if(Auth::user()->nivel_acesso == 1)
                                                        <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Editar"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                                    @endif
                                                    @if(Auth::user()->nivel_acesso == 1)
                                                    <buttonex modalnome="saidaDelete" cssbtn="btn btn-danger btn-sm" tooltipname="Deletar" cssicon="fas fa-trash-alt" url="estoque/show/" id="{{$item->id}}"></buttonex>
                                                    @endif
                            
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

  

<!-- Modal -->
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
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Excluir</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
        </div>
    </formulario>
</modal>

<modal nome="cadastro" titulo="Cadastrar">
        <formulario token="{{ csrf_token() }}" action="{{ route('form.store') }}" method="post">
                <div class="row">
                        <div class="form-group col-md-2">
                            <label for="inputEmail4">Cod. Produto</label>
                            <input type="text" class="form-control" name="codigo_produto" placeholder="Digite codigo...." required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputEmail4">Nome Produto</label>
                            <input type="text" class="form-control" name="nome_produto" placeholder="Digite Nome do Produto...." required>
                        </div>
                        <div class="form-group col-md-5">
                        <label for="inputState">Categoria</label>
                        <select  class="form-control" name="categoria_id" required>
                            <option value="">Selecione Categoria</option>
                            @foreach ($lista_categoria as $item)
                            <option value="{{$item->id}}">{{$item->categoria}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Quantidade</label>
                            <input type="text" class="form-control" name="qtd_estoque" placeholder="Digite quantidade...." required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Valor</label>

                            <div class="form-group input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" name="valor" v-money="money" class="form-control" placeholder="Digite valor...." required>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Cadastrar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>

                            </div>
                    </div>

        </formulario>
</modal>
@endsection

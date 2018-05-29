@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <br>
                @include('includes.alerts')
            <h1 class="page-header">Estoque</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Estoque</li>
                </ol>
            </nav>
        </div>

    </div>
    <div class="row">

    <div class="col-lg-12">
        <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a class="nav-link active" ><i class="fa fa-list" aria-hidden="true"></i> Lista</a>
            </li>
            @if(Auth::user()->nivel_acesso == 1)
            <li class="nav">
                <a class="btn" data-toggle="modal"  data-target="#cadastro" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
            </li>
            @endif
                <div class="pull-right ">
                    <form method="POST" class="form form-inline" action="{{ route('estoque.search') }}">
                    {!! csrf_field()  !!}
                        <input type="text" name="codigo_produto" class="form-control" placeholder="Digite codigo do produto">
                        <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">

                        <input type="number" name="qtd_estoque" class="form-control" placeholder="Digite a quantidade">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
        </ul>
        <!-- Table -->
        <div class="table-responsive">
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


                        <a href="{{ route('estoque.historicoview', $item->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Historico"><i class="fa fa-history" aria-hidden="true"></i></a>
                        @if(Auth::user()->nivel_acesso == 1)
                             <a href="{{ route('estoque.entradaform', $item->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Entrada"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        @endif

                        @if($item->qtd_estoque != 0)
                            <a href="{{ route('estoque.saidaform', $item->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Saida"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        @endif

                        @if(Auth::user()->nivel_acesso == 1)
                            <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        @endif
                        @if(Auth::user()->nivel_acesso == 1)
                        <buttonex modalnome="saidaDelete" cssbtn="btn btn-danger btn-sm" tooltipname="Deletar" cssicon="fa fa-trash-o" url="estoque/show/" id="{{$item->id}}"></buttonex>
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
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
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

                        <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-primary">Adicionar</button>

                            </div>
                    </div>

        </formulario>
</modal>
@endsection

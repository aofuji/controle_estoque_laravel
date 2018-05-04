@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Saida</h1>
        </div>
    </div>
    <div class="row">           
  
    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">      
                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#saidaCad" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                   
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead >
                                <tr >
                                    <th>#</th>
                                    <th>Nome Produto</th>
                                    <th>Criado em</th>
                                    <th>Atualizado</th>
                                    <th>Valor</th>
                                    <th>Qtd Saida</th>
                                    <th>Ação</th>
                                    
                                </tr>
                            </thead>
                        <tbody>
                        @foreach ($list_saida as $saida)
                            <tr>
                                <td>{{$saida->id}}</td>
                                <td>{{$saida->nome_produto}}</td>
                                <td>{{ date('d/m/Y - H:i:s a', strtotime($saida->created_at)) }}</td>
                                <td>{{ date('d/m/Y - H:i:s a', strtotime($saida->updated_at)) }}</td>
                                <td>R$ {{number_format($saida->valor, 2, ',', '.')}}</td>    
                                <td>{{$saida->qtd_saida}}</td>
                                <td>
                                    <buttonedit modalnome="saidaEdit" url="saida/edit/" idsaida="{{$saida->id}}"></buttonedit>
                                    <buttondelete modalnome="saidaDelete"  url="saida/edit/" idsaida="{{$saida->id}}"></buttondelete>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="text-center">
                            {!! $list_saida->links() !!}
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
<modal nome="saidaCad" titulo="Cadastrar Saida">
    <div>
        <formulario token="{{ csrf_token() }}" class="form" v:bind:action="saida" method="post">
    
            <div class="form-group">
                <label>Nome Produto</label>
                <input name="produto_id"  class="form-control">
            </div>

            <div class="form-group">
                <label>Qtd Saida</label>
                <input name="qtd_saida" class="form-control">
            </div>

            <div class="form-group">
                <label>Valor</label>
                <input name="valor" class="form-control">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </formulario>
    </div>
</modal>

<modal nome="saidaEdit" titulo="Editar Saida">
        <formulario token="{{ csrf_token() }}" v-bind:action="'saida/update/'+ $store.state.item.id" teste="teste" method="post">
            <div class="form-group">
                <label>Nome Produto</label>

                <input name="produto_id" v-model="$store.state.item.produto_id" class="form-control">
            </div>

            <div class="form-group">
                <label>Qtd Saida</label>
                <input name="qtd_saida" v-model="$store.state.item.qtd_saida" class="form-control">
            </div>

            <div class="form-group">
                <label>Valor</label>
                <div class="form-group input-group">
                    <span class="input-group-addon">R$</span>
                    <input type="text" name="valor" v-model="$store.state.item.valor" v-money="money" class="form-control">
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </formulario>
</modal>

<modal nome="saidaDelete" titulo="Excluir">
    <formulario token="{{ csrf_token() }}" v-bind:action="'saida/delete/'+ $store.state.item.id" method="post">
        <h3>Deseja exluir a Saida ?</h3>
        <p>#ID @{{$store.state.item.id}} </p>
        <p>Nome @{{$store.state.item.produto_id}}</p>
        <p>Valor @{{$store.state.item.valor}}</p>
        <p>Quantidade @{{$store.state.item.qtd_saida}}</p>
    
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Excluir</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        </div>
    </formulario>
</modal>
@endsection


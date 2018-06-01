@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Saida</h1>
            <br>
            @include('includes.alerts')
        </div>
    </div>

    <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                            <form action="{{route('estoque.saida',$item->id)}}" method="post">
                                    {!! csrf_field()  !!}
        
                                        <div class="row">
                                            <div class="form-group col-md-2">
                                                <label>Codigo do Produto</label>
                                                <input type="text" class="form-control" value="{{$item->codigo_produto}}" disabled>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label>Nome</label>
                                                <input type="text" class="form-control" value="{{$item->nome_produto}}" disabled>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Quantidade</label>
                                                <input type="text" class="form-control" value="{{$item->qtd_estoque}}" disabled>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Valor</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">R$</span>
                                                    <input type="text" v-money="money" class="form-control" value="{{number_format($item->valor, 2, ',', '.')}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <saidacliente v-bind:url="{{json_encode($lista_cliente)}}">
                                                <div class="pull-right">
                                                    <a href="" data-toggle="modal"  data-target="#cadastro" ><i class="fa fa-plus" aria-hidden="true"></i> Adicionar</a>
                                                   </div>
                                            </saidacliente>
                                            <div class="form-group col-md-2">
                                                <label>Saida</label>
                                            <input type="number" min="1" max="{{$item->qtd_estoque}}" class="form-control" name="qtd_saida" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-sign-out-alt"></i> Cadastrar</button>
                                                    <a href="{{ route('estoque') }}" class="btn btn-default"><i class="fas fa-undo-alt"></i> Voltar</a>
                                            </div>
                                        </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-body no-padding">
                                <table class="table table-striped" >
                                        <thead>
                                            <tr>
                                                <th>#</th>   
                                                <th>Tipo</th>   
                                                <th>Qtd Entrada</th>   
                                                <th>Valor Unitario</th>   
                                                <th>Valor Total</th>   
                                                <th>Usuario</th>   
                                                <th>Obs</th>   
                                                <th>Cliente</th>        
                                                <th>Data</th>        
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($historico as $item)
                                            <tr> 
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->tipo}}</td>
                                                <td>{{$item->qtd}}</td>
                                                <td>R$ {{number_format($item->valor_unitario, 2, ',', '.')}}</td>
                                                <td>R$ {{number_format($item->valor_total, 2, ',', '.')}}</td>
                                                <td>{{$item->usuario}}</td>
                                                <td>{{$item->obs}}</td>
                                                <td>{{$item->nome}}</td>
                                                <td>{{date('d/m/Y - H:i:s', strtotime($item->created_at))}}</td>
                                            </tr>
                                            
                                        @endforeach  
                                        
                                        @if($contador == 0)
                                        <tr>
                                            <th scope="row"></th>
                                            <th scope="row">Nenhum registro</th>
                                            <td colspan="7"></td>
                                        </tr>
                                    
                                        @endif
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>

            
            


<modal nome="cadastro" titulo="Cadastrar Cliente">
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
                            <input type="text" class="form-control" maxlength="11" name="telefone" placeholder="Digite Telefone" required>
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

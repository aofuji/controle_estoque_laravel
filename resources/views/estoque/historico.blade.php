@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-lg-12">
                <h1 class="">Histórico</h1>
                <br>
                @include('includes.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h5 class="panel-title"><strong>Cod.</strong> {{$produto->codigo_produto}}</h5>
                            <p class="panel-subtitle"><strong>Nome Produto</strong> {{$produto->nome_produto}}</p>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('report.historico', $idestoque) }}" class="form-inline" method="get">
                                <select class="form-control" name="tipo" required>
                                    <option value="">Selecione Tipo</option>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saida</option>
                                </select>
                                <div class='input-group date' id='data_inicial'>
                                    <input type='text' class="form-control" name="data_inicial" placeholder="Data Inicial" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <div class='input-group date' id='data_final'>
                                    <input type='text' class="form-control" name="data_final" placeholder="Data Final" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Relatorio</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <form action="{{ route('estoque.historicosearch', $idestoque) }}" class="form-inline" method="post">
                                {!! csrf_field()  !!}
                                <select class="form-control" name="tipo">
                                    <option value="">Selecione</option>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saida</option>
                                </select>
                                <a type="submit" class="btn btn-primary form-control"><i class="fa fa-search" ></i></a>
                            </form>
                        </div>  
                    </div>
                    <div class="panel-body">
                            <table class="table table-striped" >
                                    <thead>
                                        <tr>
                                            <th>#</th>   
                                            <th>Tipo</th>   
                                            <th>Qtd</th>   
                                            <th>Valor Uni.</th>   
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
                                <div class="text-center">
                                    {!! $historico->links() !!}
                                </div>
                    </div>
                </div>
            </div>
        </div>


        


@endsection
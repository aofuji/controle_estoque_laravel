@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Histórico</h1>
                    <h4><strong>Cod.</strong> {{$produto->codigo_produto}}</h4>
                    <h4><strong>Nome Produto</strong> {{$produto->nome_produto}}</h4>
                </div>
               
                <div class="row">
        <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
                    
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            
                            <form action="{{ route('estoque.historicosearch', $idestoque) }}" class="form-inline" method="post">
                                {!! csrf_field()  !!}
                                
                                <select class="form-control" name="tipo">
                                    <option value="">Selecione</option>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saida</option>
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Pesquisar</button>
                            </form>
                        </div>
                      </div>
                    </div>
                <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>#</th>   
                                        <th>Tipo</th>   
                                        <th>Quantidade</th>   
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
                    
                            <div class="text-center">
                                {!! $historico->links() !!}
                            </div>
                        </div>
                    <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                </div>
        </div>
    </div>
  </div>
</div>

@endsection
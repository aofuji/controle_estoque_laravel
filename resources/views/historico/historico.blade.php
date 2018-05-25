@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Historico</h1>
        </div>
    </div>

    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="row">
                        
                       <div class="col-lg-6 col-md-6 col-sm-6">
                            
                            <form action="{{ route('report.historicoall') }}" class="form-inline" method="get">
                               
                                
                                <select class="form-control" name="tipo">
                                    <option value="">Selecione</option>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saida</option>
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Relatorio</button>
                            </form>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">   
                                <form method="POST" class="form form-inline" action="">
                                {!! csrf_field()  !!}
                                    
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
                                        <th>Estoque</th>   
                                        <th>Data Criação</th>   
                                         
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
                                        <td>{{$item->nome_produto}}</td>
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
                                {{$historico}}
                            </div>
                        </div>
                    <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                </div>
    </div>

</div>
@endsection

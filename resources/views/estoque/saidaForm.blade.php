@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Saida</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('estoque')}}">Estoque</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Saida</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.alerts')
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
                                    <input type="number" min="1" max="{{$item->qtd_estoque}}" class="form-control" name="qtd_saida" required>
                                    </div>              
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-primary ">Cadastrar</button>
                                        <a href="{{ route('estoque') }}" class="btn">Voltar</a>
                                    </div>
                                </div>
                    </form>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">     
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h5><strong>Últimas Saidas </strong></h5>
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
                                            
                                        </div>
                                    </div>
                                <!-- /.table-responsive -->
                                </div>
                            <!-- /.panel-body -->
                            </div>
                    </div>
                </div>
</div>
@endsection

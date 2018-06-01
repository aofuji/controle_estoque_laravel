@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="">Entrada</h1>
            <br>
            @include('includes.alerts')
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                
                <div class="panel-body">
                        <form action="{{route('estoque.entrada',$item->id)}}" method="post">
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
                                    <input  type="hidden" name="nome_produto" value="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Quantidade</label>
                                    <input type="text" class="form-control" value="{{$item->qtd_estoque}}" disabled>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Valor</label>
                                    <div class="form-group input-group">
                                            <span class="input-group-addon">R$</span>
                                            <input type="text" class="form-control" value="{{number_format($item->valor, 2, ',', '.')}}" disabled>
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
                                        <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Cadastrar</button>
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
            
            

@endsection

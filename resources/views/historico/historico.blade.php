@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Historico</h1>
        </div>
        <div class="col-lg-12">              
            <form action="{{ route('report.historicoall') }}" class="form-inline" method="get">
                <select class="form-control" name="tipo">
                    <option value="">Selecione</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Saida">Saida</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Relatorio</button>
            </form>
        </div>
    </div>
<br>
    <div class="col-lg-12">
        <ul class="nav nav-tabs">
            <li class="nav-item active">
                <a class="nav-link active" ><i class="fa fa-list" aria-hidden="true"></i> Lista</a>
            </li>                    
            <div class="pull-right">   
                <form method="POST" class="form form-inline" action="{{ route('historico.search') }}">
                    {!! csrf_field()  !!}
                    <select class="form-control" name="tipo">
                        <option value="">Selecione</option>
                        <option value="Entrada">Entrada</option>
                        <option value="Saida">Saida</option>
                    </select>
                    <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">
                    <input type="text" name="nome_cliente" class="form-control" placeholder="Digite o nome cliente">

                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </ul>
                    
    <div class="table-responsive">
        <table class="table table-striped" >
            <thead>
                <tr>
                    <th>#</th>   
                    <th>Tipo</th>   
                    <th>Qtd Ent./Sai.</th>   
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
   </div>
</div>
@endsection

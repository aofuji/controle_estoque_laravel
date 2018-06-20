@extends('layouts.app')

@section('content')
    <historico>
        <form action="{{ route('report.historicoall') }}" class="form-inline" method="get" target="_blank">
            <select class="form-control" name="tipo">
                <option value="">Selecione</option>
                <option value="Entrada">Entrada</option>
                <option value="Saida">Saida</option>
            </select>
            <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">
            <input type="text" name="nome_cliente"  class="form-control" placeholder="Digite o nome cliente">
            <button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Relatorio</button>
        </form>
    </historico>
@endsection

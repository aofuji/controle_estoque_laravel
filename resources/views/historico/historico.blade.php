@extends('layouts.app')

@section('content')
    <historico>
        <form action="{{ route('report.historicoall') }}" class="form" method="get" target="_blank">
            <div class="row">
                <div class="col-md-4">
                    <label>Tipo</label>
                    <select class="form-control" name="tipo">
                        <option value="">Selecione</option>
                        <option value="Entrada">Entrada</option>
                        <option value="Saida">Saida</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Data incial</label>
                    <input type="datetime-local" name="data_inicial" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Data final</label>
                    <input type="datetime-local" name="data_final" class="form-control" required>
                </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-md-6">
                            <label>Nome Produto</label>
                        <input type="text" name="nome_produto" class="form-control" placeholder="Digite nome do produto">
                    </div>
                    <div class="col-md-6">
                            <label>Nome Cliente</label>
                        <input type="text" name="nome_cliente"  class="form-control" placeholder="Digite o nome cliente">
                    </div>
            </div>
            <br>
           <div class="row">
               <div class="col-md-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Relatorio</button>
               </div>
           </div>
        </form>
    </historico>
@endsection

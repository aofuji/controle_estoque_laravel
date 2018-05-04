@extends('layouts.app')

@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form Edição</h1>
                </div>
            </div>

        <div class="row">
            <form>
                    <div class="form-group">
                        <label>Nome Produto</label>
                        <input   class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Qtd Saida</label>
                        <input  class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Valor</label>
                        <input  class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button  class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
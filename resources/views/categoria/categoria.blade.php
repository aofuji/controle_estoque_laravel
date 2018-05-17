@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Categoria</h1>
        </div>
        
    </div>
    <div class="row">
    <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-sm-6">      
                                <a class="btn btn-primary btn-sm"  href="" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                            <div class="col-lg-7 col-md-12 col-sm-12">   
                                <form method="POST" class="form form-inline" action="">
                                {!! csrf_field()  !!}
                                    
                                    <input type="text" name="nome" class="form-control" placeholder="">
                                  

                                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                    @include('includes.alerts')
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categorias</th>                
                                    <th>Ações</th>
                                </tr>
                            </thead>
                        <tbody>
                        
                        @foreach ($lista as $item)
                            <tr >
                                <td>{{$item->id}}</td>
                                <td>{{$item->categoria}}</td>
                               
                                
                                <td>
                                    
                                    <a href="" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <buttondelete modalnome="clienteDelete"  url="cliente/show/" idsaida="{{$item->id}}"></buttondelete> 
                                </td>
                            </tr>
                        @endforeach    
                        </tbody>
                        </table>
                            <div class="text-center">
                             
                            </div>
                    </div>
                <!-- /.table-responsive -->
                    </div>
                <!-- /.panel-body -->
                    </div>
                <!-- /.panel -->
        </div>
    </div>

    
</div>

@endsection

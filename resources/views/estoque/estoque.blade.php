@extends('layouts.app')

@section('content')

<estoque 
    gate_entrada="{{$gate_entrada}}" 
    gate_edit="{{$gate_edit}}" 
    gate_delete="{{$gate_delete}}"
    gate_add="{{$gate_add}}"
    gate_import="{{$gate_import}}"></estoque>
@endsection
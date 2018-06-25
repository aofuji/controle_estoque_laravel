@extends('layouts.app')

@section('content')
<permission :lista="{{json_encode($permissions)}}"></permission>
@endsection
@extends('layouts.app')

@section('content')
<div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                            <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                                
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Senha" name="password" type="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>Lembrar
                                        </label>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" >Entrar</button>
                                
                            </form>
                    </div>
                </div>
        </div>
</div>
    @endsection
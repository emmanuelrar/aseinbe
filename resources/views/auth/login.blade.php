@extends('layouts.app')

@section('style')
    <style>
        #login-form {
            padding-top: 25vh;
        }
        #login-logo {
            padding-top: 10vh;
        }
        #img-logo {
            position: absolute;
            left: 43%;
            right: 43%;
            height: 110px;
            width: auto;
        }
    </style>
@endsection

@section('content')
<div id="login-logo" class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <img id="img-logo" src="{{ asset('img/Logo.png') }}">
        </div>
    </div>
    <div id="login-form" class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">SNG</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-3 col-sm-3 control-label">Correo</label>

                            <div class="col-md-6 col-sm-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>Este correo no esta registrado.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-3 col-sm-3 control-label">Contraseña</label>

                            <div class="col-md-6 col-sm-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>Contraseña incorrecta.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Mantener sesión
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                <button type="submit" class="btn btn-outline-* btn-block">Ingresar</button>
                            </div>                            
                            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 center text-center">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

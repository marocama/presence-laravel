@extends('adminlte::page')

@section('content_header')
    <h1>Perfil</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Perfil</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-xs-12 col-md-5">
        <div class="box box-success">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="User profile picture">
                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                @if($city != NULL)
                    <p class="text-muted text-center">{{ $city->name }}</p>
                @else
                    <p class="text-muted text-center">Cidade Não Definida</p>
                @endif
                <br>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Permissão</b>
                        <a class="pull-right">
                            @if(auth()->user()->can === 'trainee')
                                Estágiario
                            @elseif(auth()->user()->can === 'manager')
                                Administrador
                            @elseif(auth()->user()->can === 'master')
                                Master
                            @else
                                Indef.
                            @endif
                        </a>
                    </li>
                    <li class="list-group-item">
                        <b>Tag</b>
                        <a class="pull-right">
                            @if(auth()->user()->uid != NULL)
                                {{ auth()->user()->uid }}
                            @else
                                Não Cadastrado
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-7">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Alterar Senha</h3>
            </div>
            <form role="form" method="POST" action="{{ route('profile.alterPass') }}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="passwordNov">Nova Senha</label>
                        <input type="password" class="form-control" id="passwordNov" name="passwordNov" placeholder="Nova Senha">
                    </div>
                    <div class="form-group">
                        <label for="passwordCon">Confirmar Senha</label>
                        <input type="password" class="form-control" id="passwordCon" name="passwordCon" placeholder="Confirmar Senha">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="form-control btn btn-flat btn-success">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

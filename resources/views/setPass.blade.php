@extends('adminlte::page')

@section('content_header')
    <h1>Alterar Senha</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Alterar Senha</a></li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <form role="form" method="POST" action="{{ route('setPass.alterPass') }}">
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
                    <button type="submit" class="form-control btn btn-success">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
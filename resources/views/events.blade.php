@extends('adminlte::page')

@section('content_header')
    <h1>Eventos</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Eventos</a></li>
        <li><a href="#">Cadastrar</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">       
            <div class="box-header with-border">           
                <h3 class="box-title">Cadastrar Evento</h3>
            </div>
            <form role="form" method="POST" action="{{ route('events.add') }}">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group">
                        <label for="nameEvent">Nome do Evento</label>
                        <input type="text" class="form-control" id="nameEvent" name="nameEvent" placeholder="Nome do Evento">
                    </div>
                    <div class="form-group">
                        <label>Data</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="date" class="form-control" id="dateEvent" name="dateEvent">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Horário</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="time" class="form-control" id="timeEvent" name="timeEvent">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="form-control btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
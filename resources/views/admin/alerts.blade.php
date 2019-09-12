@extends('adminlte::page')

@section('content_header')
    <h1>Administrador</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Alertas</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Lançar Alerta</h3>
            </div>
            <div class="box-body">
                <form role="form" method="POST" action="{{ route('alerts.reg') }}">
                    {!! csrf_field() !!}
                    <div class="box-body">
						<div class="row">
							<div class="col-xs-3">
								<label>Título</label>
								<input type="text" name="title" class="form-control" placeholder="Título">
							</div>
							<div class="col-xs-6">
								<label>Mensagem</label>
								<input type="text" name="message" class="form-control" placeholder="Mensagem">
							</div>
							<div class="col-xs-3">
								<label>Tipo</label>
								<select name="type" class="form-control">
									<option value="info" class="bg-info">Info</option>
									<option value="primary" class="bg-primary">Primary</option>
									<option value="secondary" class="bg-secondary">Secondary</option>
									<option value="danger" class="bg-danger">Danger</option>
									<option value="warning" class="bg-warning">Warning</option>
								</select>
							</div>
						</div><br>
						<div class="row">
							<div class="col-xs-3">
								<label>Ícone</label>
								<input type="text" name="icon" class="form-control" placeholder="info-circle">
							</div>
							<div class="col-xs-3">
								<label>Permissão</label>
								<input type="text" name="can" class="form-control" placeholder="trainee">
							</div>
							<div class="col-xs-3">
								<label>Iniciar em</label>
								<input type="text" name="startShow" class="form-control" placeholder="2019-01-30 12:45:00">
							</div>
							<div class="col-xs-3">
								<label>Finalizar em</label>
								<input type="text" name="endShow" class="form-control" placeholder="2019-01-30 12:45:00">
							</div>
						</div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-flat btn-block btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@forelse ($alerts as $alert)
    <div class="callout callout-{{$alert->type}}">
        <h4><font style="vertical-align: inherit;"><i class="icon fa fa-{{$alert->icon}} fa-fw"></i> {{$alert->title}}</font></h4>
        <p><font style="vertical-align: inherit;">{{$alert->message}}</font></p>
    </div>
@empty
@endforelse
@stop
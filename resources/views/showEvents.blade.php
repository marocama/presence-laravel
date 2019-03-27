@extends('adminlte::page')

@section('content_header')
    <h1>Eventos</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Eventos</a></li>
        <li><a href="#">Visualizar</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Próximos Eventos</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th>Nome do Evento</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Horário</th>
                        <th>Criador</th>
                    </tr>
                    <?php $cont = 1 ?>
                    @forelse($datas as $data)
                        @if (strtotime(date("Y-m-d")) < strtotime($data->date))
                            <tr>
                                <td>{{ $cont }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="text-center">{{ date_format(date_create($data->date), 'd/m/Y') }}</td>
                                <td class="text-center">{{ date_format(date_create($data->time), 'H:i') }}</td>
                                <td>{{ $data->user->name }}</td>
                            </tr>
                            <?php $cont++ ?>
                        @endif
                    @empty
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
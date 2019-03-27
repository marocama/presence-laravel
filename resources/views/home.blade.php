@extends('adminlte::page')

@section('content_header')
    <h1>Home</h1>
@stop

@section('content')
    <p>Bem-vindo(a), <b>{{ $name }}</b>!</p><br>
    @include('includes.alerts')
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Próximo Evento</span>
                    <span class="info-box-number">
                        {{ ($events != null) ? $events['name'] : 'Não há eventos cadastrados' }}
                    </span>
                    <span class="info-box-number">
                        {{ ($events != null) ? date_format(date_create($events['date']), 'd/m/Y') : '--/--/----' }}
                        <small> às {{ ($events != null) ? date_format(date_create($events['time']), 'H:i') : '--:--' }}</small>
                    </span>
                </div>
            </div>
        </div>
    <div class="clearfix visible-sm-block"></div>
    </div>
    <?php $cont = 0; ?>
    @forelse($presences as $presence)
        @if (date("m") == date_format(date_create($presence->date), 'm'))
            <?php $cont++ ?>
        @endif
    @empty
    @endforelse
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-calendar-times-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Presença - Este Mês</span>
                    <span class="info-box-number"> {{ $cont }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description text-center"><a href="{{ route('presence') }}" class="text-gray">Mais informações <i class="fa fa-arrow-circle-right"></i>
            </a></span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-reorder"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Presença - Total</span>
                    <span class="info-box-number"> {{ count($presences) }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description text-center"><a href="{{ route('presence') }}" class="text-gray">Mais informações <i class="fa fa-arrow-circle-right"></i>
            </a></span>
                </div>
            </div>
        </div>
    </div>   
@stop
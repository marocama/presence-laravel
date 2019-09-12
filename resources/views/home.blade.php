@extends('adminlte::page')

@section('content_header')
    <h1>Home - PMMU</h1>
@stop

@section('content')
    <p>Bem-vindo(a), <b>{{ $name }}</b>!</p><br>
    @include('includes.alerts')
    @forelse ($alerts as $alert)
        @if(strtotime($alert->endShow) > strtotime('now') && $alert->can == auth()->user()->can)
        <div class="callout callout-{{$alert->type}}">
            <h4><font style="vertical-align: inherit;"><i class="icon fa fa-{{$alert->icon}} fa-fw"></i> {{$alert->title}}</font></h4>
            <p><font style="vertical-align: inherit;">{{$alert->message}}</font></p>
        </div>
        @endif
    @empty
    @endforelse
    @if($pmmu)
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="info-box bg-purple">
                <span class="info-box-icon"><i class="fa fa-file"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">PMMU - {{$pmmu->name}}</span>
                    <span class="info-box-number">{{$percent}}% Concluído</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: {{$percent}}%"></div>
                    </div>
                    <span class="progress-description text-center"><strong>Prazo Final:</strong> {{date('d M. Y', strtotime($pmmu->timesEnd))}} </span>
                </div>
            </div>
        </div>
    </div> 
    @endif
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="info-box bg-navy">
                <span class="info-box-icon"><i class="fa fa-calendar-times-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Presença</span>
                    @if($presence != NULL)
                        @if(date('d/m/Y', strtotime($presence->checkIn)) == date('d/m/Y', strtotime('now')))
                            @if($presence->checkOut)
                                <span class="info-box-number">Validação completa!</span>
                            @else
                                <span class="info-box-number">Check-in realizado!</span>
                            @endif
                        @else
                            <span class="info-box-number">Nenhum registro hoje!</span>
                        @endif
                    @else
                        <span class="info-box-number">Nenhum registro hoje!</span>
                    @endif
                    <div class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                    <span class="progress-description text-center"><a href="{{ route('presence') }}" class="text-gray">Mais informações <i class="fa fa-fw fa-arrow-circle-right"></i>
            </a></span>
                </div>
            </div>
        </div>
    </div>   
@stop
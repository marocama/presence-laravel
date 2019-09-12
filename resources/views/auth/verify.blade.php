@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado ao seu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de prosseguir, clique no link de ativação enviado ao seu email.') }}
                    {{ __('Se você não recebeu, ') }}, <a href="{{ route('verification.resend') }}">{{ __('clique aqui para enviar novamente') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

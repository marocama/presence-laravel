@extends('adminlte::page')

@section('content_header')
    <h1>Presença</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">Presença</a></li>
    </ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-6 col-xs-12">
        <a href="{{ route('setPresence') }}" class="btn btn-block btn-success btn-social">
            <i class="fa fa-chevron-down"></i> Registrar Entrada
        </a>
    </div>
    <div class="clearfix visible-sm-block"></div><br><br>
    <div class="col-md-12 col-sm-6 col-xs-12">
        <a href="{{ route('setCheckout') }}"class="btn btn-block btn-warning btn-social">
            <i class="fa fa-chevron-up"></i> Registrar Saída
        </a>
    </div>
</div>
<div class="clearfix visible-sm-block"></div><br>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Registro Pessoal</h3>
            </div>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Entrada</th>
                        <th>Saída</th>
                        <th>Confiabilidade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($presences as $presence)
                        <tr>
                            <td>{{ $presence->date }}</td>
                            <td>{{ $presence->loc_c }}</td>
                            <td>{{ date_format(date_create($presence->check_in), 'H:i') }}</td>
                            <td>
                                @if ($presence->check_out != NULL)
                                    {{ date_format(date_create($presence->check_out), 'H:i') }}
                                @else
                                    Indef.
                                @endif
                            </td>
                            <td>
                                @if ($presence->conf_o == null) 
                                    {{ $presence->conf_i }}
                                @else 
                                    {{ ($presence->conf_i + $presence->conf_o) / 2 }}
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop

@section('js')
    <script>
        $(function () {
            $('#example').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    }
                }
            });
        });
    </script>
@stop
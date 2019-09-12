@extends('adminlte::page')

@section('content_header')
    <h1>PMMU</h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#">PMMU</a></li>
    </ol>
@stop

@section('content')
@include('includes.alerts')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">{{$city->name}}</h3>
            </div>
            <div class="box-body">
                <div class="tab-content">
                    <ul class="timeline timeline-inverse">
                        <li class="time-label">
                            <span class="bg-green">
                                {{date('d M. Y', strtotime($city->timesStart))}}
                            </span>
                        </li>
                        <li>
                            <i class="@if($city->statusInicioAtividades == 'p') fa fa-clock-o bg-gray @elseif($city->statusInicioAtividades == 'e') fa fa-edit bg-yellow @else fa fa-check bg-green @endif"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    @if($city->timeInicioAtividades == null)
                                    Não Iniciado
                                    @elseif($city->statusInicioAtividades == 'c')
                                    Finalizado em: {{date('d/m/y à\s H:i', strtotime($city->timeInicioAtividades))}}
                                    @elseif($city->statusInicioAtividades == 'e')
                                    Atualizado em: {{date('d/m/y à\s H:i', strtotime($city->timeInicioAtividades))}}
                                    @endif
                                </span>
                                <h3 class="timeline-header"><strong>Início das Atividades</strong></h3>
                                <div class="timeline-body">
                                    <p>Documentação Inicial para início da elaboração do PMMU.</p>
                                    <p><i class="@if($city->fileCartaIntecao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Carta de Intenção</p>
                                    <p><i class="@if($city->fileTermoCooperacao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Termo de Cooperação Técnica-Científica</p>
                                    <p><i class="@if($city->fileTermoAditivo != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Termo Aditivo I</p>
                                </div>
                                <div class="timeline-footer">
                                    <button type="button" class="btn @if($city->statusInicioAtividades == 'c') bg-green @elseif($city->statusInicioAtividades == 'e') bg-yellow @else bg-gray @endif" data-toggle="modal" data-target="#modal-inicio">Visualizar</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="@if($city->statusFormaEstagios == 'p') fa fa-clock-o bg-gray @elseif($city->statusFormaEstagios == 'e') fa fa-edit bg-yellow @else fa fa-check bg-green @endif"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    @if($city->timesFormaEstagios == null)
                                    Não Iniciado
                                    @elseif($city->statusFormaEstagios == 'c')
                                    Finalizado em: {{date('d/m/Y à\s H:i', strtotime($city->timesFormaEstagios))}}
                                    @elseif($city->statusFormaEstagios == 'e')
                                    Atualizado em: {{date('d/m/Y à\s H:i', strtotime($city->timesFormaEstagios))}}
                                    @endif
                                </span>
                                <h3 class="timeline-header"><strong>Formalização dos Estágios</strong></h3>
                                <div class="timeline-body">
                                    <p>Procedimento para formalização dos estágios por meio do CIEE ou NEP. </p>
                                    <p><i class="@if($city->statusFormaEstagios == 'c') fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Escolha do Intermediador </p>
                                </div>
                                <div class="timeline-footer">
                                    <button type="button" class="btn @if($city->statusFormaEstagios == 'c') bg-green @elseif($city->statusFormaEstagios == 'e') bg-yellow @else bg-gray @endif" data-toggle="modal" data-target="#modal-formaliza">Visualizar</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="@if($city->status1Apresentacao == 'p') fa fa-clock-o bg-gray @elseif($city->status1Apresentacao == 'e') fa fa-edit bg-yellow @else fa fa-check bg-green @endif"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    @if($city->times1Apresentacao == null)
                                    Não Iniciado
                                    @elseif($city->status1Apresentacao == 'c')
                                    Finalizado em: {{date('d/m/Y à\s H:i', strtotime($city->times1Apresentacao))}}
                                    @elseif($city->status1Apresentacao == 'e')
                                    Atualizado em: {{date('d/m/Y à\s H:i', strtotime($city->times1Apresentacao))}}
                                    @endif
                                </span>
                                <h3 class="timeline-header"><strong>1ª Apresentação</strong></h3>
                                <div class="timeline-body">
                                    <p>Audiência pública para apresentação do PMMU. </p>
                                    <p><i class="@if($city->fileGrupoLocal != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Criação do Grupo de Trabalho</p>
                                    <p><i class="@if($city->fileConvite != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Convite</p>
                                    <p><i class="@if($city->fileAta != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Ata de Presença</p>
                                </div>
                                <div class="timeline-footer">
                                    <button type="button" class="btn @if($city->status1Apresentacao == 'c') bg-green @elseif($city->status1Apresentacao == 'e') bg-yellow @else bg-gray @endif" data-toggle="modal" data-target="#modal-apres1">Visualizar</button>
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="@if($city->statusProduto1 == 'p') fa fa-clock-o bg-gray @elseif($city->statusProduto1 == 'e') fa fa-edit bg-yellow @else fa fa-check bg-green @endif"></i>
                            <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i>
                                    @if($city->timesProduto1 == null)
                                    Não Iniciado
                                    @elseif($city->statusProduto1 == 'c')
                                    Finalizado em: {{date('d/m/Y à\s H:i', strtotime($city->timesProduto1))}}
                                    @elseif($city->statusProduto1 == 'e')
                                    Atualizado em: {{date('d/m/Y à\s H:i', strtotime($city->timesProduto1))}}
                                    @endif
                                </span>
                                <h3 class="timeline-header"><strong>Produto 1</strong></h3>
                                <div class="timeline-body">
                                    <p>Elaboração e Entrega do Produto 1.</p>
                                    <p><i class="@if($city->fileApresentacao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Apresentação</p>
                                    <p><i class="@if($city->fileDescObjetivo != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Descrição do Objetivo</p>
                                    <p><i class="@if($city->fileMobilidade != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Mobilidade Urbana</p>
                                    <p><i class="@if($city->filePoliticaNasc != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Política Nacional de Mobilidade Urbana</p>
                                    <p><i class="@if($city->fileBaseConsti != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Base Constitucional para Implantação do Plano de Mobilidade Urbana</p>
                                    <p><i class="@if($city->fileInvestimentos != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Investimentos em Mobilidade</p>
                                    <p><i class="@if($city->fileMeioAmbiente != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Meio Ambiente e Mobilidade</p>
                                    <p><i class="@if($city->fileHistorico != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Histórico do Município</p>
                                    <p><i class="@if($city->fileDistribuicao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Distribuição Urbanística</p>
                                    <p><i class="@if($city->fileTerritorio != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Território e População</p>
                                    <p><i class="@if($city->fileCaracterizacao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Caracterização Ambiental</p>
                                    <p><i class="@if($city->fileAtrativos != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Atrativos Turísticos do Município</p>
                                    <p><i class="@if($city->fileDesenvolvimentos != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Desenvolvimentos Industriais e Rurais</p>
                                    <p><i class="@if($city->fileFrota != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Frota Urbanística do Município</p>
                                    <p><i class="@if($city->fileLinhas != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Linhas Rodoviárias</p>
                                    <p><i class="@if($city->fileJustificativa != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Justificativa</p>
                                    <p><i class="@if($city->fileObjetivo != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Objetivo</p>
                                    <p><i class="@if($city->fileMetodologia != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> Metodologia</p>
                                </div>
                                <div class="timeline-footer">
                                    <button type="button" class="btn @if($city->statusProduto1 == 'c') bg-green @elseif($city->statusProduto1 == 'e') bg-yellow @else bg-gray @endif" data-toggle="modal" data-target="#modal-prod1">Visualizar</button>
                                </div>
                            </div>
                        </li>
                        <li class="time-label">
                            <span class="bg-red">{{date('d M. Y', strtotime($city->timesEnd))}}</span>
                        </li>
                    </ul>
                </div>  
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Log de Atividades</h3>
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Usuário</th>
                            <th>Ação</th>
                            <th>Data</th>
                        </tr>
                        @forelse ($logs as $log)
                        <tr>
                            <td>{{$log->user->name}}</td>
                            <td>{{$log->action}}</td>
                            <td>
                                @if (date('d/m/Y') == date('d/m/Y', strtotime($log->created_at)))
                                Hoje, às {{ date('H:i', strtotime($log->created_at)) }}
                                @elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($log->created_at)))
                                Ontem, às {{ date('H:i', strtotime($log->created_at)) }}
                                @else
                                {{ date('d/m/Y à\s H:i', strtotime($log->created_at)) }}
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">Nenhum registro para exibir</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-inicio">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Início das Atividades</h4>
            </div>
            <form role="form" method="POST" action="{{ route('upload.inicio') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input id="city" name="city" type="hidden" value="{{$city->id}}">
                <div class="modal-body">
                    <p><i class="@if($city->fileCartaIntecao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Carta de Intenção</strong></p>
                    <p>Para o Início das atividades, deve haver a manifestação de interesse por parte da Prefeitura através da <strong>Carta de Intenção</strong>.</p>
                    <p>No modelo disponível para download deve-se atentar:</p>
                    <ul>
                        <li>Data da Assinatura</li>
                        <li>Nome completo do Reitor ou representante da Universidade</li>
                        <li>Nome da Prefeitura</li>
                        <li>Nome completo do Prefeito</li>
                    </ul>
                    <p class="text-muted">Lembrando ainda que o número e registro do ofício destacados devem ser preenchidos pela Prefeitura, que poderá ainda anexar ao documento cabeçalho e rodapé exclusivos de cada cidade.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="intencao">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/INICIO_ATIVIDADES/CARTA_INTENCAO_MODELO.doc') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileCartaIntecao != null)  <a href="{{ asset('storage/uploads/'.$city->fileCartaIntecao) }}"> {{$city->fileCartaIntecao}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>    
                    <p><i class="@if($city->fileTermoCooperacao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Termo de Cooperação Técnico-Científica</strong></p>
                    <p>Após a manifestação de interesses, devem ser assinados o <strong>Termo de Cooperação Técnico-Científica</strong> e o Termo Aditivo para elaboração do Plano Municipal de Mobilidade Urbana.</p>
                    <p>O Termo de Cooperação tem o objetivo de firmar o primeiro elo entre a Cidade e a Universidade.</p>
                    <p>Tendo sido assinado, qualquer atividade, trabalho ou projeto objeto de interesse da Prefeitura pode ser elaborado através de um Termo Aditivo posterior.</p>
                    <p>Lembrando ainda que, o Termo de Cooperação não é exclusivo para projetos vinculados ao Curso de Engenharia Civil, podendo ser vinculado mediante Termo Aditivo à qualquer curso presente na USF.</p>
                    <p>No modelo disponível para download deve-se atentar:</p>
                    <ul>
                        <li>Data da Assinatura</li>
                        <li>Nome completo do Reitor ou representante da Universidade</li>
                        <li>Dados completos da Prefeitura</li>
                        <li>Dados completos do Prefeito</li>
                    </ul>
                    <p class="text-muted">Atentando-se ainda que o Partícipe do Termo, poderá ser um Consórcio ou Grupo representante de várias Cidades, como no caso do Consórcio do Circuito das Águas.</p>
                    <p class="text-muted">No Termo então, devem ser trocados todos os espaços preenchidos com <strong>“PREFEITURA”</strong>, por <strong>“CONSÓRCIO”</strong> ou qualquer que seja a representatividade.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="cooperacao">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/INICIO_ATIVIDADES/TERMO_COOPERACAO_MODELO.doc') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileTermoCooperacao != null)  <a href="{{ asset('storage/uploads/'.$city->fileTermoCooperacao) }}"> {{$city->fileTermoCooperacao}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>  
                    <p><i class="@if($city->fileTermoAditivo != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Termo Aditivo</strong></p>
                    <p>O <strong>Termo Aditivo</strong> descreve as atividades para elaboração do Plano Municipal de Mobilidade Urbana, tal como as obrigações e deveres da Prefeitura para com a Universidade e vice-versa.</p>
                    <p>Para elaboração do PMMU, deverão ser contratados 4 estagiários para Municípios até 30 mil habitantes, e 1 estagiário adicional para cada 10 mil habitantes excedentes.</p>
                    <p>No modelo disponível para download deve-se atentar:</p>
                    <ul>
                        <li>Data da Assinatura</li>
                        <li>Nome completo do Reitor ou representante da Universidade</li>
                        <li>Dados completos da Prefeitura</li>
                        <li>Dados completos do Prefeito</li>
                        <li>Cursos envolvidos na elaboração do Plano</li>
                        <li>Número de Estagiários Envolvidos</li>
                    </ul>
                    <p class="text-muted">Atentando-se ainda que o Partícipe do Termo, poderá ser um Consórcio ou Grupo representante de várias Cidades, como no caso do Consórcio do Circuito das Águas.</p>
                    <p class="text-muted">No Termo então, devem ser trocados todos os espaços preenchidos com <strong>“PREFEITURA”</strong>, por <strong>“CONSÓRCIO”</strong> ou qualquer que seja a representatividade.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="aditivo">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/INICIO_ATIVIDADES/TERMO_ADITIVO_MODELO.doc') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileTermoAditivo != null)  <a href="{{ asset('storage/uploads/'.$city->fileTermoAditivo) }}"> {{$city->fileTermoAditivo}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>  
                    <strong><p>É importante que todos os três documentos sejam encaminhados para a Prefeitura correspondente, para que se necessário anexem seu logotipo, cabeçalho e rodapé.</p>
                    <p>Nesta primeira etapa, todos os documentos podem ser assinados mais de uma vez só em evento programado em conjunto com o Marketing da Universidade.</p></strong>            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-formaliza">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Formalização dos Estágios</h4>
            </div>
            <form role="form" method="POST" action="{{ route('upload.formaliza') }}">
                {!! csrf_field() !!}
                <input id="city" name="city" type="hidden" value="{{$city->id}}">
                <div class="modal-body">
                    <p><i class="@if($city->statusFormaEstagio == 'c') fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Escolha do Intermediador</strong></p>
                    <p>Finalizadas as assinatura dos contratos, a equipe deve se informar qual será o meio de formalização dos estágios.</p>
                    <p>Dependendo da cidade, pode-se optar pela intermediação pelo <strong>CIEE</strong> (Centro de Integração Empresa-Escola) ou diretamente pelo <strong>NEP</strong> (Núcleo de Empregabilidade e Empreendedorismo da USF).</p>
                    <hr>
                    <p><strong>Formalização pelo NEP:</strong></p>
                    <p class="text-muted">Caso for optado pela contratação pelo NEP, confira o <strong>Fluxograma de geração</strong> e a entrega da <strong>Documentação de Estágio</strong> <a href="">clicando aqui</a>.
                    <p class="text-muted">Além destes, confira os tipos de documentos disponíveis <a href="">clicando aqui</a>.
                    <hr>
                    <p><strong>Formalização pelo CIEE:</strong></p>
                    <p class="text-muted">Caso a Prefeitura opte pela contratação através do CIEE, o estagiário deve preencher a ficha enviada pelo próprio CIEE com os documentos necessários.</p>
                    <p class="text-muted">Aconselha-se deixar separado cópia de seus documentos (CPF, RG, Comprovante de Residência e Certificado de Matrícula (que pode ser adquirido na seção de Protocolos Online, em seu USF Connect)) logo que a Prefeitura interessada entrar em contato com a associação.</P>
                    <p class="text-muted">Após Cadastro enviado, os contratos devem ser assinados em 3 vias que serão entregues a cada uma das partes.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Feito</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-apres1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">1ª Apresentação</h4>
            </div>
            <form role="form" method="POST" action="{{ route('upload.1apresentacao') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input id="city" name="city" type="hidden" value="{{$city->id}}">
                <div class="modal-body">
                    <p><i class="@if($city->fileGrupoLocal != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Criação do Grupo de Trabalho Local</strong></p>
                    <p>Para que o projeto tenha o devido reconhecimento, legitimidade e possa ser utilizado adequadamente perante o Governo Federal, é imprescindível que a comunidade participe dos resultados, decisões, e mudanças propostas pelo Plano de Mobilidade.</p>
                    <p>Para tal, é criado o <strong>Grupo de Trabalho Local</strong>, através de um Decreto Municipal, cujo modelo está disposto.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="grupo">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/1_APRESENTACAO/GRUPO_TRABALHO_MODELO.docx') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileGrupoLocal != null)  <a href="{{ asset('storage/uploads/'.$city->fileGrupoLocal) }}"> {{$city->fileGrupoLocal}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>  
                    <p><i class="@if($city->fileConvite != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Primeira Audiência</strong></p>
                    <p>Deve ser requisitado junto à Prefeitura com o representante interno, uma lista de pessoas influentes que participarão de todas as audiências, proporcionando a visibilidade adequada ao projeto.</p>
                    <p>A Equipe Técnica deve elaborar um convite em formato de foto, que será enviado por <strong>e-mail</strong> e <strong>WhatsApp</strong>, segundo modelo disposto.</p>
                    <p>Vale ressaltar a importância da criação de materiais para divulgação em todos os canais de comunicação entre a Administração e população, como folders, cartazes, banners, propagandas na rádio, site da prefeitura, redes sociais, etc.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="audiencia">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/1_APRESENTACAO/CONVITE_AUDIÊNCIA_MODELO_1.jpeg') }}" download class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo 1</a>
                            <a href="{{ asset('docs/1_APRESENTACAO/CONVITE_AUDIÊNCIA_MODELO_2.png') }}" download class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo 2</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileConvite != null)  <a href="{{ asset('storage/uploads/'.$city->fileConvite) }}"> {{$city->fileConvite}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr> 
                    <p><i class="@if($city->fileAta != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Ata de Presença</strong></p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="ata">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/1_APRESENTACAO/ATA_MODELO_1.docx') }}" download class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileAta != null)  <a href="{{ asset('storage/uploads/'.$city->fileAta) }}"> {{$city->fileAta}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-prod1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Produto 1</h4>
            </div>
            <form role="form" method="POST" action="{{ route('upload.produto1') }}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <input id="city" name="city" type="hidden" value="{{$city->id}}">
                <div class="modal-body">
                    <p>O Produto I é o mais importante, pois é a etapa em que a equipe levanta todos os dados e características da cidade em questão, além de desenvolver toda a justificativa do projeto.</p>
                    <p>Para essa fase do projeto, devem ser desenvolvidos os seguintes tópicos:</p>
                    <p><i class="@if($city->fileApresentacao != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i> <strong>Apresentação</strong></p>
                    <ul>
                        <li>Breve descrição sobre o convênio firmado entre a USF e a Prefeitura, com datas dos eventos e documentos provenientes dos mesmos.</li>
                        <li>Plano Municipal de Mobilidade Urbana enquanto documento e os motivos que levaram a necessidade de desenvolvê-lo.</li>
                        <li>As etapas de desenvolvimento e o conteúdo resumido com objeto de pesquisa dos Produtos I, II, III e IV.</li>
                    </ul>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="apresentacao">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/PRODUTO_1/APRESENTACAO_MODELO.pptx') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                           <span class="pull-right">Enviado: @if($city->fileApresentacao != null)  <a href="{{ asset('storage/uploads/'.$city->fileApresentacao) }}"> {{$city->fileApresentacao}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>
                    <p><i class="fa fa-fw fa-info-circle"></i><strong>Introdução</strong></p>
                    <ul>
                        <li><strong>Descrição do Objetivo</strong></li>
                        <p>Neste tópico, deve-se descrever as características gerais do Plano de Mobilidade, e quais ferramentas serão utilizadas para sua criação, como por exemplo, os processos do Grupo de Trabalho. Além de citar a lei federal nº 12.587 de 2012.</p>
                        <p>O tópico deve ser completo, com no mínimo meia página de conteúdo e no máximo uma página.</p>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="descObjetivo">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileDescObjetivo != null)  <a href="{{ asset('storage/uploads/'.$city->fileDescObjetivo) }}"> {{$city->fileDescObjetivo}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Mobilidade Urbana</strong></li>
                        <p>Neste tópico, deve-se explorar todas as características do termo “mobilidade urbana” e as áreas que podem ser englobadas ao se realizar o plano.</p>
                        <p>Levantar dentro deste tópico ainda, quais os benefícios para a cidade quando se aplica os métodos e objetivos da Mobilidade.</p>
                        <p>Lembrando que é importante sempre se basear nos planos anteriores sem copiar trechos diretos.</p>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="mobilidadeUrbana">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileMobilidade != null)  <a href="{{ asset('storage/uploads/'.$city->fileMobilidade) }}"> {{$city->fileMobilidade}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Política Nacional de Mobilidade Urbana</strong></li>
                        <p>Descrever os objetivos, diretrizes e requisitos da Política Nacional de Mobilidade Urbana, lei federal nº 12.587 de 2012.</p>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="politicaNasc">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->filePoliticaNasc != null)  <a href="{{ asset('storage/uploads/'.$city->filePoliticaNasc) }}"> {{$city->filePoliticaNasc}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Base Constitucional para Implantação do Plano de Mobilidade Urbana</strong></li>
                        <br>
                        <ul>
                            <li><strong>Constituição Federal</strong></li>
                            <p>Deve-se descrever dentro do âmbito da Constituição Federal, as partes que envolvem a produção do Plano de Mobilidade, Política de desenvolvimento e Planejamento Urbano, neste caso consultar Art.182 da Lei nº13.311, de 11 de julho de 2016.</p>
                            <p>Consultar ainda alterações que possam surgir no decorrer do tempo, incluindo neste tópico para complementar a pesquisa.</p>
                            <li><strong>Legislação Federal</strong></li>
                            <p>Descrever a fundo qualquer lei, artigo, parágrafo, envolvida no tópico anterior e qualquer atualização que ocorrera entra o desenvolvimento de um plano e outro.</p>
                            <p class="text-muted">Consultar os planos anteriores.</p>
                            <li><strong>Legislação Municipal</strong></li>
                            <p>Realizar uma pesquisa acerca das legislações e decretos, aprovados ou não, acerca dos temas envolvidos, como por exemplo: Plano de Mobilidade, Política de desenvolvimento e Planejamento Urbano.</p>
                            <p>Explorar: <strong>Leis Orgânicas</strong> / <strong>Plano Diretor</strong> / <strong>Plano Diretor de Turismo</strong>.</p>
                            <p>Além de qualquer normativa que diz respeito ao município, quanto o território, transporte, trânsito (sinalização, organização, etc.) e meio ambiente.</p>
                            <p class="text-muted">Consultar os planos anteriores.</p>
                        </ul>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="baseConsti">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileBaseConsti != null)  <a href="{{ asset('storage/uploads/'.$city->fileBaseConsti) }}"> {{$city->fileBaseConsti}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Investimentos em Mobilidade</strong></li>
                        <p>Redigir este tópico se baseando em um tema principal: “A importância da Mobilidade Urbana nos desenvolvimentos sustentável das cidades”.</p>
                        <p>O capítulo deve conter ainda citações sobre as políticas públicas nacionais e/ou municipais que ditam o manejo adequado para manutenção da cidade de forma sustentável.</p>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="investimentos">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileInvestimentos != null)  <a href="{{ asset('storage/uploads/'.$city->fileInvestimentos) }}"> {{$city->fileInvestimentos}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Meio Ambiente e Mobilidade</strong></li>
                        <p>Este capítulo é de grande importância para garantir que as soluções apresentadas no decorrer do Plano Municipal de Mobilidade Urbana sejam executadas.</p>
                        <p>A equipe deve realizar uma pesquisa sobre as ferramentas disponíveis para aquisição de verba por parte da Prefeitura.</p>
                        <p>Verificar o trabalho continuado de Joanópolis sobre esse tema. Exemplos: Programas de Financiamento/Facilidades para a Prefeitura adquirir verba do Estado/Federação. <strong>(Ex: Programa 2048, Fundo Perdido, Pró-transportes, Mcidades.)</strong>.</p>
                        <p class="text-muted">Para o embasamento inicial de cada tópico, consultar planos anteriores.</p>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="meioAmbiente">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileMeioAmbiente != null)  <a href="{{ asset('storage/uploads/'.$city->fileMeioAmbiente) }}"> {{$city->fileMeioAmbiente}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                    </ul>
                    <hr>
                    <p><i class="fa fa-fw fa-info-circle"></i><strong>Caracterização Geral do Município</strong></p>
                    <p>Os capítulos subsequentes são essenciais para o desenvolvimento do plano, tendo em vista que o aprofundamento nas características da cidade, leva a uma melhor interpretação das necessidades, compreensão de como surgiram as dificuldades e situações, além de melhor adaptar os resultados e soluções.</p>
                    <p>É importante realizar uma busca ampla pelos dados de cada município, lembrando que os tópicos criados abaixo, são fruto do histórico de todos os Planos desenvolvidos até o presente momento. Portanto, se houver a necessidade a equipe poderá criar novos tópicos, complementando com conteúdo relevante ao desenvolvimento do PMMU.</p>
                    <ul>
                        <li><strong>Histórico do Município</strong></li>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="historico">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileHistorico != null)  <a href="{{ asset('storage/uploads/'.$city->fileHistorico) }}"> {{$city->fileHistorico}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Distribuição Urbanística</strong></li>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="distribuicao">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileDistribuicao != null)  <a href="{{ asset('storage/uploads/'.$city->fileDistribuicao) }}"> {{$city->fileDistribuicao}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Território e População</strong></li>
                        <ul>
                            <li>Perímetro urbano</li>
                            <li>Expansão Urbana</li>
                        </ul>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="territorio">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileTerritorio != null)  <a href="{{ asset('storage/uploads/'.$city->fileTerritorio) }}"> {{$city->fileTerritorio}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Caracterização Ambiental</strong></li>
                        <ul>
                            <li>Clima</li>
                            <li>Geologia</li>
                            <li>Áreas de Proteção Ambiental</li>
                            <li>Unidades de Conservação</li>
                            <li>Biomas presentes dentro do município</li>
                            <li>Caracterização da vegetação</li>
                            <li>Divisão de área por macrozoneamento</li>
                            <li>Atividade rural</li>
                            <li>Rios</li>
                            <li>Abastecimento de água</li>
                            <li>Principais usos d’água</li>
                            <li>Descarte de resíduos sólidos</li>
                        </ul> 
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="caracterizacao">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileCaracterizacao != null)  <a href="{{ asset('storage/uploads/'.$city->fileCaracterizacao) }}"> {{$city->fileCaracterizacao}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Atrativos Turísticos do Município</strong></li>
                        <ul>
                            <li>Plano Diretor de Desenvolvimento Turístico do Município</li>
                            <li>Tombamento patrimonial</li>
                        </ul> 
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="atrativos">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileAtrativos != null)  <a href="{{ asset('storage/uploads/'.$city->fileAtrativos) }}"> {{$city->fileAtrativos}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Desenvolvimentos Industriais e Rurais</strong></li>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="desenvolvimentos">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileDesenvolvimentos != null)  <a href="{{ asset('storage/uploads/'.$city->fileDesenvolvimentos) }}"> {{$city->fileDesenvolvimentos}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Frota Urbanística do Município</strong></li>
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="frota">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileFrota != null)  <a href="{{ asset('storage/uploads/'.$city->fileFrota) }}"> {{$city->fileFrota}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                        <hr>
                        <li><strong>Linhas Rodoviárias</strong></li> 
                        <br>
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <input type="file" class="btn bg-olive btn-sm btn-block" name="linhas">
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <span class="pull-right">Enviado: @if($city->fileLinhas != null)  <a href="{{ asset('storage/uploads/'.$city->fileLinhas) }}"> {{$city->fileLinhas}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                            </div>
                        </div>
                    </ul>
                    <hr>
                    <p><i class="@if($city->fileJustificativa != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i><strong>Justificativa</strong></p>
                    <p>Importante tópico para a aceitação de modo geral do Plano Municipal de Mobilidade Urbana.</p>
                    <p>A justificativa para elaboração do Plano, deve abordar o histórico da importância da mobilidade urbana no desenvolvimento das cidades, com dados estatísticos, sobre frotas urbanísticas, acidentes, melhorias para a população, etc.</p>
                    <p class="text-muted">Consultar capítulo nos planos desenvolvidos anteriormente.</p> 
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="justificativa">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileJustificativa != null)  <a href="{{ asset('storage/uploads/'.$city->fileJustificativa) }}"> {{$city->fileJustificativa}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>
                    <p><i class="@if($city->fileObjetivo != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i><strong>Objetivo</strong></p>
                    <p>Neste capítulo, descrever os objetivos e metas principais que serão abordados no Plano.</p>
                    <p>Tendo alinhado as expectativas iniciais com a Prefeitura e seus supervisores, a equipe deve citá-las no decorrer do texto, para que ao concluir o projeto possam evidenciar o que foi atingido, superado ou não.</p>
                    <p>Incluir neste tópico o fluxograma de atividades resumido para cada etapa.</p>
                    <p class="text-muted">Consultar capítulo nos planos desenvolvidos anteriormente.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="objetivo">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileObjetivo != null)  <a href="{{ asset('storage/uploads/'.$city->fileObjetivo) }}"> {{$city->fileObjetivo}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    <hr>
                    <p><i class="@if($city->fileMetodologia != null) fa fa-fw fa-check-circle text-success @else fa fa-fw fa-clock-o text-warning @endif"></i><strong>Metodologia</strong></p>   
                    <p>Descrever os métodos e a logística usada para elaboração do Plano, seguindo orientações do Ministério das Cidades.</p>
                    <p>Destrinchar o motivo do Plano ser entregue em “Produtos”, explicando cada etapa em um subcapítulo, com suas datas prováveis.</p>
                    <p>Incluir neste tópico o cronograma físico por etapa, destacando reuniões e os dias/semanas em que cada atividade será desenvolvida.</p>
                    <p>O Produto I é preenchido com as expectativas para cada atividade, abrangendo o máximo de informações possíveis, com a importância de se Mobilizar a população e destacar a responsabilidade do Grupo de Trabalho criado.</p>
                    <p class="text-muted">O modelo está disponível, e deve ser preenchido se baseando nos planos anteriores.</p>
                    <br>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <input type="file" class="btn bg-olive btn-sm btn-block" name="metodologia">
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <a href="{{ asset('docs/PRODUTO_1/') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-fw  fa-download"></i> Modelo</a>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="pull-right">Enviado: @if($city->fileMetodologia != null)  <a href="{{ asset('storage/uploads/'.$city->fileMetodologia) }}"> {{$city->fileMetodologia}} @else <span class="text-warning">Pendente</span> @endif</a></span>
                        </div>
                    </div>
                    </ul>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    $(function(){  		
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	});
</script>
@endsection

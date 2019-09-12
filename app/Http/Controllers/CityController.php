<?php

namespace App\Http\Controllers;

use App\Log;
use App\Models\City;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index($id)
    {
        if(auth()->user()->can != "master" && auth()->user()->can != "manager" && auth()->user()->city_id != $id)
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui permissão para acessar essa página.');
        
        $city = City::findOrFail($id);
        $logs = Log::where('city_id', $id)->latest()->get();
        return view('city', compact('city', 'logs'));
    }

    // ****************************************************************************************************************
    // ****************************************************************************************************************
    // ***** UPLOAD DE ARQUIVOS - INICIO DAS ATIVIDADES ***************************************************************
    // ****************************************************************************************************************
    // ****************************************************************************************************************
    public function fileUploadInicio(Request $request, Log $log)
    {
        if ($request->city != auth()->user()->city_id)
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui permissão para acessar este recurso.');
        
        $city = City::findOrFail($request->city);  

        if ($request->hasFile('intencao') && $request->file('intencao')->isValid())
        {
            if ($request->intencao->extension() != "doc" && $request->intencao->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_CARTA_INTENCAO.".$request->intencao->extension();
            $update = $request->intencao->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileCartaIntecao);

            $city->fileCartaIntecao = $nameFile;
            $city->timeInicioAtividades = date('Y-m-d H:i:s');

            if ($city->fileTermoCooperacao != null && $city->fileTermoAditivo != null)
            {
                $city->statusInicioAtividades = "c";
                $city->statusFormaEstagios = "e";
            }

            $city->save();

            $log->register("Envio: Carta de Intenção");
        }

        if ($request->hasFile('cooperacao') && $request->file('cooperacao')->isValid())
        {
            if ($request->cooperacao->extension() != "doc" && $request->cooperacao->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_TERMO_COOPERACAO.".$request->cooperacao->extension();
            $update = $request->cooperacao->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileTermoCooperacao);

            $city->fileTermoCooperacao = $nameFile;
            $city->timeInicioAtividades = date('Y-m-d H:i:s');

            if ($city->fileCartaIntecao != null && $city->fileTermoAditivo != null)
            {
                $city->statusInicioAtividades = "c";
                $city->statusFormaEstagios = "e";
            }

            $city->save();

            $log->register("Envio: Termo de Cooperação");
        }

        if ($request->hasFile('aditivo') && $request->file('aditivo')->isValid())
        {
            if ($request->aditivo->extension() != "doc" && $request->aditivo->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_TERMO_ADITIVO.".$request->aditivo->extension();
            $update = $request->aditivo->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileTermoAditivo);

            $city->fileTermoAditivo = $nameFile;
            $city->timeInicioAtividades = date('Y-m-d H:i:s');

            if ($city->fileTermoCooperacao != null && $city->fileCartaIntecao != null)
            {
                $city->statusInicioAtividades = "c";
                $city->statusFormaEstagios = "e";
            }

            $city->save();

            $log->register("Envio: Termo Aditivo");
        }

        return redirect()
                    ->route('home')
                    ->with('success', 'Alterações salvas com sucesso.');
    }

    // ****************************************************************************************************************
    // ****************************************************************************************************************
    // ***** UPLOAD DE ARQUIVOS - FORMALIZAÇÃO DOS ESTÁGIOS ***********************************************************
    // ****************************************************************************************************************
    // ****************************************************************************************************************
    public function fileUploadFormalizacao(Request $request, Log $log)
    {
        if ($request->city != auth()->user()->city_id)
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui permissão para acessar este recurso.');
        
        $city = City::findOrFail($request->city);  

        $city->timesFormaEstagios = date('Y-m-d H:i:s');
        $city->statusFormaEstagios = "c";
        $city->status1Apresentacao = "e";

        $city->save();

        $log->register("Finalizou: Formalização dos Estágios");

        return redirect()
                    ->route('home')
                    ->with('success', 'Alterações salvas com sucesso.');
    }

    // ****************************************************************************************************************
    // ****************************************************************************************************************
    // ***** UPLOAD DE ARQUIVOS - 1ª APRESENTAÇÃO *********************************************************************
    // ****************************************************************************************************************
    // ****************************************************************************************************************
    public function fileUpload1Apresentacao(Request $request, Log $log)
    {
        if ($request->city != auth()->user()->city_id)
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui permissão para acessar este recurso.');
        
        $city = City::findOrFail($request->city);  

        if ($request->hasFile('grupo') && $request->file('grupo')->isValid())
        {
            if ($request->grupo->extension() != "doc" && $request->grupo->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_GRUPO_TRABALHO.".$request->grupo->extension();
            $update = $request->grupo->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileGrupoLocal);

            $city->fileGrupoLocal = $nameFile;
            $city->times1Apresentacao = date('Y-m-d H:i:s');

            if ($city->fileConvite != null && $city->fileAta != null)
            {
                $city->status1Apresentacao = "c";
                $city->statusProduto1 = "e";
            }

            $city->save();

            $log->register("Envio: Grupo de Trabalho");
        }

        if ($request->hasFile('audiencia') && $request->file('audiencia')->isValid())
        {
            if ($request->audiencia->extension() != "doc" && $request->audiencia->extension() != "docx" && $request->audiencia->extension() != "png" && $request->audiencia->extension() != "jpeg" && $request->audiencia->extension() != "jpg" && $request->audiencia->extension() != "pdf")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc, .docx, .png, .jpg, .jpeg ou .pdf.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_CONVITE.".$request->audiencia->extension();
            $update = $request->audiencia->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileConvite);

            $city->fileConvite = $nameFile;
            $city->times1Apresentacao = date('Y-m-d H:i:s');

            if ($city->fileGrupoLocal != null && $city->fileAta != null)
            {
                $city->status1Apresentacao = "c";
                $city->statusProduto1 = "e";
            }

            $city->save();

            $log->register("Envio: Convite Audiência");
        }

        if ($request->hasFile('ata') && $request->file('ata')->isValid())
        {
            if ($request->ata->extension() != "doc" && $request->ata->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_ATA.".$request->ata->extension();
            $update = $request->ata->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileAta);

            $city->fileAta = $nameFile;
            $city->times1Apresentacao = date('Y-m-d H:i:s');

            if ($city->fileConvite != null && $city->fileGrupoLocal != null)
            {
                $city->status1Apresentacao = "c";
                $city->statusProduto1 = "e";
            }

            $city->save();

            $log->register("Envio: Ata de Presença");
        }

        return redirect()
                    ->route('home')
                    ->with('success', 'Alterações salvas com sucesso.');
    }

    // ****************************************************************************************************************
    // ****************************************************************************************************************
    // ***** UPLOAD DE ARQUIVOS - PRODUTO 1 ***************************************************************************
    // ****************************************************************************************************************
    // ****************************************************************************************************************
    public function fileUploadProduto1(Request $request, Log $log)
    {
        if ($request->city != auth()->user()->city_id)
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui permissão para acessar este recurso.');
        
        $city = City::findOrFail($request->city);  

        if ($request->hasFile('apresentacao') && $request->file('apresentacao')->isValid())
        {
            if ($request->apresentacao->extension() != "doc" && $request->apresentacao->extension() != "docx" && $request->apresentacao->extension() != "pptx" && $request->apresentacao->extension() != "ppt" && $request->apresentacao->extension() != "pdf")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc, .docx, .pptx, .ppt ou .pdf.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_APRESENTACAO.".$request->apresentacao->extension();
            $update = $request->apresentacao->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileApresentacao);

            $city->fileApresentacao = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileDescObjetivo != null && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Apresentação Produto 1");
        }

        if ($request->hasFile('descObjetivo') && $request->file('descObjetivo')->isValid())
        {
            if ($request->descObjetivo->extension() != "doc" && $request->descObjetivo->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_DESC_OBJETIVO.".$request->descObjetivo->extension();
            $update = $request->descObjetivo->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileDescObjetivo);

            $city->fileDescObjetivo = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Descrição do Objetivo");
        }

        if ($request->hasFile('mobilidadeUrbana') && $request->file('mobilidadeUrbana')->isValid())
        {
            if ($request->mobilidadeUrbana->extension() != "doc" && $request->mobilidadeUrbana->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_MO_URBANA.".$request->mobilidadeUrbana->extension();
            $update = $request->mobilidadeUrbana->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileMobilidade);

            $city->fileMobilidade = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Mobilidade Urbana");
        }

        if ($request->hasFile('politicaNasc') && $request->file('politicaNasc')->isValid())
        {
            if ($request->politicaNasc->extension() != "doc" && $request->politicaNasc->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc, .docx, .pptx, .ppt ou .pdf.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_POLITICA_NA.".$request->politicaNasc->extension();
            $update = $request->politicaNasc->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->filePoliticaNasc);

            $city->filePoliticaNasc = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileMobilidade != null && $city->fileDescObjetivo != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Política Nacional");
        }

        if ($request->hasFile('baseConsti') && $request->file('baseConsti')->isValid())
        {
            if ($request->baseConsti->extension() != "doc" && $request->baseConsti->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_BASE_CONST.".$request->baseConsti->extension();
            $update = $request->baseConsti->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileBaseConsti);

            $city->fileBaseConsti = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Base Constitucional");
        }

        if ($request->hasFile('investimentos') && $request->file('investimentos')->isValid())
        {
            if ($request->investimentos->extension() != "doc" && $request->investimentos->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_INVESTIMENTOS.".$request->investimentos->extension();
            $update = $request->investimentos->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileInvestimentos);

            $city->fileInvestimentos = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Investimentos");
        }

        if ($request->hasFile('meioAmbiente') && $request->file('meioAmbiente')->isValid())
        {
            if ($request->meioAmbiente->extension() != "doc" && $request->meioAmbiente->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_MEIO_AMBIENTE.".$request->meioAmbiente->extension();
            $update = $request->meioAmbiente->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileMeioAmbiente);

            $city->fileMeioAmbiente = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Meio Ambiente");
        }

        if ($request->hasFile('historico') && $request->file('historico')->isValid())
        {
            if ($request->historico->extension() != "doc" && $request->historico->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_HISTORICO.".$request->historico->extension();
            $update = $request->historico->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileHistorico);

            $city->fileHistorico = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Histórico");
        }

        if ($request->hasFile('distribuicao') && $request->file('distribuicao')->isValid())
        {
            if ($request->distribuicao->extension() != "doc" && $request->distribuicao->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_DIST_URBAN.".$request->distribuicao->extension();
            $update = $request->distribuicao->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileDistribuicao);

            $city->fileDistribuicao = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Distribuição Urbanística");
        }

        if ($request->hasFile('territorio') && $request->file('territorio')->isValid())
        {
            if ($request->territorio->extension() != "doc" && $request->territorio->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_TERRITORIO.".$request->territorio->extension();
            $update = $request->territorio->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileTerritorio);

            $city->fileTerritorio = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Território");
        }

        if ($request->hasFile('caracterizacao') && $request->file('caracterizacao')->isValid())
        {
            if ($request->caracterizacao->extension() != "doc" && $request->caracterizacao->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_CARACT_AMB.".$request->caracterizacao->extension();
            $update = $request->caracterizacao->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileCaracterizacao);

            $city->fileCaracterizacao = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Caracterização Ambiental");
        }

        if ($request->hasFile('atrativos') && $request->file('atrativos')->isValid())
        {
            if ($request->atrativos->extension() != "doc" && $request->atrativos->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_ATRATIVOS.".$request->atrativos->extension();
            $update = $request->atrativos->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileAtrativos);

            $city->fileAtrativos = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Atrativos");
        }

        if ($request->hasFile('desenvolvimentos') && $request->file('desenvolvimentos')->isValid())
        {
            if ($request->desenvolvimentos->extension() != "doc" && $request->desenvolvimentos->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_DES_IND_RURAIS.".$request->desenvolvimentos->extension();
            $update = $request->desenvolvimentos->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileDesenvolvimentos);

            $city->fileDesenvolvimentos = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Desenvolvimentos Ind. e Rurais");
        }

        if ($request->hasFile('frota') && $request->file('frota')->isValid())
        {
            if ($request->frota->extension() != "doc" && $request->frota->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_FROTAS.".$request->frota->extension();
            $update = $request->frota->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileFrota);

            $city->fileFrota = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Frotas Urbanísticas");
        }

        if ($request->hasFile('linhas') && $request->file('linhas')->isValid())
        {
            if ($request->linhas->extension() != "doc" && $request->linhas->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_LINHAS.".$request->linhas->extension();
            $update = $request->linhas->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileLinhas);

            $city->fileLinhas = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileJustificativa != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Linhas Rodoviárias");
        }

        if ($request->hasFile('justificativa') && $request->file('justificativa')->isValid())
        {
            if ($request->justificativa->extension() != "doc" && $request->justificativa->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_JUSTIFICATIVA.".$request->justificativa->extension();
            $update = $request->justificativa->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileJustificativa);

            $city->fileJustificativa = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileObjetivo != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Justificativa");
        }

        if ($request->hasFile('objetivo') && $request->file('objetivo')->isValid())
        {
            if ($request->objetivo->extension() != "doc" && $request->objetivo->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_OBJETIVO.".$request->objetivo->extension();
            $update = $request->objetivo->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileObjetivo);

            $city->fileObjetivo = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileMetodologia != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Objetivo");
        }

        if ($request->hasFile('metodologia') && $request->file('metodologia')->isValid())
        {
            if ($request->metodologia->extension() != "doc" && $request->metodologia->extension() != "docx")
                return redirect()
                            ->route('home')
                            ->with('error', 'Extensão não suportada, tente novamente com arquivos .doc ou .docx.');

            $nameFile = date('dmHis').kebab_case(auth()->user()->city->name)."_METODOLOGIA.".$request->metodologia->extension();
            $update = $request->metodologia->storeAs('uploads', $nameFile);   

            if (!$update)
                return redirect()
                            ->route('home')
                            ->with('error', 'Erro no upload, tente novamente.');

            Storage::delete("uploads/".$city->fileMetodologia);

            $city->fileMetodologia = $nameFile;
            $city->timesProduto1 = date('Y-m-d H:i:s');

            if ($city->fileApresentacao != null && $city->fileDescObjetivo != null  && $city->fileMobilidade != null && $city->filePoliticaNasc != null && $city->fileBaseConsti != null && $city->fileInvestimentos != null && $city->fileMeioAmbiente != null && $city->fileHistorico != null && $city->fileDistribuicao != null && $city->fileTerritorio != null && $city->fileCaracterizacao != null && $city->fileAtrativos != null && $city->fileDesenvolvimentos != null && $city->fileFrota != null && $city->fileLinhas != null && $city->fileJustificativa != null && $city->fileObjetivo != null)
            {
                $city->statusProduto1 = "c";
            }

            $city->save();

            $log->register("Envio: Metodologia");
        }

        return redirect()
                    ->route('home')
                    ->with('success', 'Alterações salvas com sucesso.');
    }
}

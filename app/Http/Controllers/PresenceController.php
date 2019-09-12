<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;

class PresenceController extends Controller
{
    // ******************************
    // ** Exibe a página de presenças
    public function index() 
    {
        $presences = auth()->user()->presences()->latest()->get();
        return view('presence', compact('presences'));
    }

    // ************************************************
    // ** Efetua presença pela plataforma para Campinas
    public function write(Request $request, Presence $presence)
    {
        if(auth()->user()->campus != "cam")
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar este recurso.');

        $record = $presence->registerPlatform($request->local);

        if($record['success'])
            return redirect()
                        ->route('presence')
                        ->with('success', 'Operação realizada com sucesso.');

        return redirect()
                        ->route('presence')
                        ->with('error', 'Ocorreu um erro, tente novamente.');
    }

    // ***************************************
    // ** Efetua presença pelo sistema de RFID
    public function rfid(Request $request, Presence $presence)
    {
        if($request->token_access == "9g8peWj75l6")
        {
            $record = $presence->register($request->ud);

            if($record['success'])  
                return response('', 201);
            
            return response('', 409);
        }

        return response('', 401);
    }

    // **************************************************
    // ** Gera um PDF com as presenças do mês selecionado
    public function list(Request $request)
    {
        $data = auth()->user()->presences()->whereMonth('checkIn', $request->month)->get();

        setlocale (LC_ALL, 'pt_BR');
        $monthWri = ucfirst(strftime('%B', mktime(0, 0, 0, $request->month, 1, date('Y'))));
        $monthSta = strtotime(mktime(1, 1, 1, $request->month, 1, date('Y')));
        $monthNum = $request->month;

        $name = auth()->user()->name;

        $pdf = \PDF::loadView('presencePDF', compact(['data', 'monthWri', 'monthSta', 'monthNum', 'name']));  
        return $pdf->stream();
    }
}

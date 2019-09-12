<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Models\City;
use App\Http\Requests\UserValidationFormRequest;
use Illuminate\Foundation\Auth\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $presence = auth()->user()->presences()->latest()->first();
        $name = auth()->user()->name;
        $alerts = Alert::get();

        $pmmu = auth()->user()->city()->first();
        $cont = 0;
        
        if ($pmmu) 
        {
            if ($pmmu->fileCartaIntecao != null) 
                $cont++;
            if ($pmmu->fileTermoCooperacao != null) 
                $cont++;
            if ($pmmu->fileTermoAditivo != null) 
                $cont++;
            if ($pmmu->statusFormaEstagios == "c") 
                $cont++;
            if ($pmmu->fileCartaIntecao != null) 
                $cont++;
            if ($pmmu->fileGrupoLocal != null) 
                $cont++;
            if ($pmmu->fileConvite != null) 
                $cont++;
            if ($pmmu->fileApresentacao != null) 
                $cont++;
            if ($pmmu->fileDescObjetivo != null) 
                $cont++;
            if ($pmmu->fileMobilidade != null) 
                $cont++;
            if ($pmmu->filePoliticaNasc != null) 
                $cont++;
            if ($pmmu->fileBaseConsti != null) 
                $cont++;
            if ($pmmu->fileInvestimentos != null) 
                $cont++;
            if ($pmmu->fileMeioAmbiente != null) 
                $cont++;
            if ($pmmu->fileHistorico != null) 
                $cont++;
            if ($pmmu->fileDistribuicao != null) 
                $cont++;
            if ($pmmu->fileTerritorio != null) 
                $cont++;
            if ($pmmu->fileCaracterizacao != null) 
                $cont++;
            if ($pmmu->fileAtrativos != null) 
                $cont++;
            if ($pmmu->fileDesenvolvimentos != null) 
                $cont++;
            if ($pmmu->fileFrota != null) 
                $cont++;
            if ($pmmu->fileLinhas != null) 
                $cont++;
            if ($pmmu->fileJustificativa != null) 
                $cont++;
            if ($pmmu->fileObjetivo != null) 
                $cont++;
            if ($pmmu->fileMetodologia != null) 
                $cont++;
        }
        
        $percent = ($cont * 100) / 25;
                
        return view('home', compact('name', 'presence', 'alerts', 'percent', 'pmmu'));
    }

    public function profile()
    {
        $city = City::find(auth()->user()->city_id);
        return view('profile', compact('city'));
    }

    public function alterPass(UserValidationFormRequest $request, User $user) 
    {
        if ($request->passwordNov == null || $request->passwordCon == null) 
            return redirect()
                        ->route('profile')
                        ->with('error', 'Preencha todos os campos');

        if ($request->passwordNov != $request->passwordCon)
            return redirect()
                        ->route('profile')
                        ->with('error', 'Você digitou senhas distintas');
        
        $password = bcrypt($request->passwordNov);

        $update = auth()->user()->update(
            array(
                'password' => $password,
            )
        );

        if ($update)
            return redirect()
                        ->route('profile')
                        ->with('success', 'Sucesso ao atualizar');

        return redirect()
                    ->route('profile')
                    ->with('error', 'Falha ao atualizar');
    }
}

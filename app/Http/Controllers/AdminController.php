<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use App\Models\Presence;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller
{
    public function index()
    {
        if(auth()->user()->can =='manager' || auth()->user()->can == 'master')
        {
            $presences = Presence::whereMonth('checkIn', '>=', date('m', strtotime('-3 month')))->get();

            $users = User::get();
            $array = array();
            $workload = 0;
            $array2 = array();

            foreach($users as $user)
            {
                $presenceCount = Presence::whereMonth('checkIn', date('m'))->where('user_id', $user->id)->get();
                $array[$user->name] = $presenceCount->count();

                $workload = 0;
                foreach($presenceCount as $presenceUn)
                {   
                    if($presenceUn->checkOut != NULL)
                        $workload += strtotime($presenceUn->checkOut) - strtotime($presenceUn->checkIn);
                }

                $array2[$user->name] = $workload;
            }
        
            return view('admin.index', compact('presences', 'array', 'array2'));
        }

        return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar este recurso.');
    }

    public function new()
    {
        if(auth()->user()->can != 'master')
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar este recurso.');

        $users = User::get();
        return view('admin.new', compact('users'));
    }

    public function register(Request $request, Presence $presence)
    {
        if(auth()->user()->can != 'master')
            return redirect()
                        ->route('home')
                        ->with('error', 'Você não possui autorização para acessar este recurso.');

        $record = $presence->manual($request->user, $request->data, $request->checkIn, $request->checkOut);

            if($record['success'])  
                return redirect()
                            ->route('new')
                            ->with('success', 'Presença Confirmada');
            
            return redirect()
                        ->route('new')
                        ->with('error', 'Ocorreu um erro, tente novamente');
    }

    public function alerts()
    {
        $alerts = Alert::get();
        return view('admin.alerts', compact('alerts'));
    }

    public function alertsReg(Request $request, Alert $alert)
    {
        $record = $alert->register($request->title, $request->message, $request->type, $request->icon, $request->can, $request->startShow, $request->endShow);
        if($record['success'])  
                return redirect()
                            ->route('alerts')
                            ->with('success', 'Alerta Definido');
            
            return redirect()
                        ->route('alerts')
                        ->with('error', 'Ocorreu um erro, tente novamente');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserValidationFormRequest;

class setPassController extends Controller
{
    public function index() 
    {
        return view('setPass');
    }

    public function alterPass(UserValidationFormRequest $request, User $user) 
    {
        if ($request->passwordNov == null || $request->passwordCon == null) 
            return [
                'success' => false,
                'message' => 'Preencha todos os campos'
            ];

        if ($request->passwordNov != $request->passwordCon)
            return [
                'success' => false,
                'message' => 'Você digitou senhas distintas'
            ];
        
        $password = bcrypt($request->passwordNov);

        $update = auth()->user()->update(
            array(
                'password' => $password,
            )
        );

        if ($update)
            return redirect()
                        ->route('home')
                        ->with('success', 'Sucesso ao atualizar');

        return redirect()
                    ->route('home')
                    ->with('error', 'Falha ao atualizar');
    }
}

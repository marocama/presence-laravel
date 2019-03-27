<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Presence;
use App\Http\Requests\PresenceValidationFormRequest;

class setCheckoutController extends Controller
{
    public function index() 
    {
        $user = auth()->user()->name;
        $names = User::get();
        return view('setCheckout', compact('names', 'user'));
    }

    public function confirm(PresenceValidationFormRequest $request, Presence $presence) 
    {
        $response = $presence->exit($request->c_x, $request->c_y, $request->local, $request->states);

        if ($response['success'])
            return redirect()
                        ->route('home')
                        ->with('success', $response['message']);
        
        return redirect()
                    ->route('home')
                    ->with('error', $response['message']);
    }
}

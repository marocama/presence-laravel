<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Http\Requests\PresenceValidationFormRequest;

class PresenceController extends Controller
{
    public function index() 
    {
        $presences = auth()->user()->presences()->get();
        return view('presence', compact('presences'));
    }
}

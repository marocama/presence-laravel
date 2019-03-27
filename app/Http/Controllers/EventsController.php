<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\EventValidationFormRequest;

class EventsController extends Controller
{
    public function index() 
    {
        return view('events');
    }

    public function add(EventValidationFormRequest $request, Event $event) 
    {
        $response = $event->register($request->nameEvent, $request->dateEvent, $request->timeEvent);

        if ($response['success'])
            return redirect()
                        ->route('home')
                        ->with('success', $response['message']);
        
        return redirect()
                    ->route('home')
                    ->with('error', $response['message']);
    }

    public function data() 
    {
        $datas = Event::with(['user'])->orderBy('date')->get();

        return view('showEvents', compact('datas'));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Event extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'date', 'time', 'user_id'];

    public function register($name, $date, $time) : Array
    {
        
        if ($name == null || $date == null || $time == null) 
            return [
                'success' => false,
                'message' => 'Preencha todos os campos'
            ];

        $event = auth()->user()->events()->create([
            'name'      => $name,
            'date'      => $date,
            'time'      => $time,
            'user_id'   => auth()->user()->id
        ]);

        if ($event) 
            return [
                'success' => true,
                'message' => 'Evento criado com sucesso' 
            ];

        return [
            'success' => false,
            'message' => 'Falha no registro, tente novamente'
        ];
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}

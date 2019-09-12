<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $fillable = [
        'title', 'message', 'type', 'icon', 'can', 'startShow', 'endShow'
    ];
	  
	// ******************************************
    // ** Recebe um POST para registrar um alerta
    public function register($title, $message, $type, $icon, $can, $start, $end)
    {   

		$record = new Alert();
		
        $record->title = $title;
		$record->message = $message;
		$record->type = $type;
        $record->icon = $icon;
		$record->can = $can;
		$record->startShow = $start;
		$record->endShow = $end;

        $record->save();

        if($record)
            return [
                'success' => true
            ];

        return [
            'success' => false
        ];
    }
}

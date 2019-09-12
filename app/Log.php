<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'action', 'user_id', 'created_at', 'updated_at'
    ];
	  
	// ***************************************
    // ** Recebe um POST para registrar um log
    public function register($action)
    {   
        $record = new Log();
		
        $record->action = $action;
        $record->user_id = auth()->user()->id;
        $record->city_id = auth()->user()->city_id;
		$record->created_at = date('Y-m-d H:i:s');
        $record->updated_at = date('Y-m-d H:i:s');

        $record->save();

        if($record)
            return [
                'success' => true
            ];

        return [
            'success' => false
        ];
    }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}

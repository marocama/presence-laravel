<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Presence extends Model
{
    protected $fillable = [
        'user_id', 'checkIn', 'checkOut', 'status', 'localE', 'localS', 'created_at', 'updated_at'
    ];

    // ******************************************
    // ** Recebe a Tag RFID e registra a presença
    public function register($user_uid) 
    {
        $user = User::where('uid', $user_uid)->first();

        if(!$user)
            return [
                'success' => false
            ];

        $record = Presence::where('user_id', $user->id)->whereDate('created_at', date('Y-m-d'))->latest()->first();
        
        if($record)
        {
            if($record->checkOut == NULL) 
            {
                $record->checkOut = date('Y-m-d H:i:s');
                $record->updated_at = date('Y-m-d H:i:s');
                $record->status = true;
                $record->localS = "RFID";
                $record->save();

                return [
                    'success' => true
                ];
            }
                
            return [
                'success' => false
            ];
        }

        $new = new Presence;

        $new->user_id = $user->id;
        $new->created_at = date('Y-m-d H:i:s');
        $new->updated_at = date('Y-m-d H:i:s');
        $new->checkIn = date('Y-m-d H:i:s');
        $new->status = false;
        $record->localE = "RFID";
        $new->save();

        if($new)
            return [
                'success' => true
            ];

        return [
            'success' => false
        ];
    } 

    // ***********************************************
    // ** Recebe o local atual para registrar presença
    public function registerPlatform($local)
    {
        $presence = auth()->user()->presences()->whereDate('created_at', date('Y-m-d'))->latest()->first();
        
        if($presence)
        {
            if($presence->checkOut == NULL) 
            {
                $presence->checkOut = date('Y-m-d H:i:s');
                $presence->updated_at = date('Y-m-d H:i:s');
                $presence->localS = $local;
                $presence->status = true;
                $presence->save();

                return [
                    'success' => true
                ];
            }
            
            return [
                'success' => false
            ];
        }

        $record = new Presence;

        $record->user_id = auth()->user()->id;
        $record->created_at = date('Y-m-d H:i:s');
        $record->updated_at = date('Y-m-d H:i:s');
        $record->checkIn = date('Y-m-d H:i:s');
        $record->localE = $local;
        $record->status = false;

        $record->save();

        if($record)
            return [
                'success' => true
            ];

        return [
            'success' => false
        ];
    }

    // *****************************************************
    // ** Recebe um POST para registrar presença manualmente
    public function manual($user_id, $data, $checkIn, $checkOut)
    {   
        $inData = $data.' '.$checkIn;
        $outData = $data.' '.$checkOut;

        $record = new Presence;
        $record->user_id = $user_id;
        $record->created_at = date('Y-m-d H:i:s');
        $record->updated_at = date('Y-m-d H:i:s');
        $record->checkIn = date_format(date_create_from_format('d/m/Y H:i', $inData), 'Y-m-d H:i:s');
        $record->checkOut = date_format(date_create_from_format('d/m/Y H:i', $outData), 'Y-m-d H:i:s');
        $record->status = true;

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

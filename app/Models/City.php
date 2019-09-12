<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class City extends Model
{
    public function user() 
    {
        return $this->hasMany(User::class);
    }
}

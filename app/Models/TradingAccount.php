<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradingAccount extends Model
{
    protected $fillable = [
        'user_id',
        'broker_type',
        'login_id',
        'server',
        'password',
        'status',
        'balance',
    ];
    //
}

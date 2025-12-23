<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiConfiguration extends Model
{
    protected $fillable = [
        'user_id',
        'trading_pair',
        'strategy_mode',
        'risk_mode',
        'auto_sl_tp',
        'news_reaction',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

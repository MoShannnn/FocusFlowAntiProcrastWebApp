<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimerSessionLog extends Model
{
    protected $fillable = [
        'duration',
        'user_id',
        'timer_session_type_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function timer_session_type(): BelongsTo
    {
        return $this->belongsTo(TimerSessionType::class);
    }
}

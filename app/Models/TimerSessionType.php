<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimerSessionType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function timer_session_logs(): HasMany
    {
        return $this->hasMany(TimerSessionLog::class);
    }
}

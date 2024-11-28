<?php

namespace App\Http\Controllers;

use App\Models\TimerSessionLog;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TimerSessionLogController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'duration' => 'required|integer',
            'timer_session_type_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        TimerSessionLog::create([
            'duration' => $request->duration,
            'timer_session_type_id' => $request->timer_session_type_id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back();
    }
}

<?php

namespace App\Listeners;

use App\Models\LoginLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->update([
            'last_login_time' => now(),
            'last_login_ip' => request()->getClientIp(),
            'agent' => request()->header('User-Agent'),
            'session_id' => request()->session()->getId()
        ]);

        LoginLog::create([
            'user_id' => $event->user->id,
            'last_login_time' => now(),
            'last_login_ip' => request()->getClientIp(),
            'agent' => request()->header('User-Agent'),
            'session_id' => session()->getId()
        ]);
    }
}

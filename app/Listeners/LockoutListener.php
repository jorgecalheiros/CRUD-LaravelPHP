<?php

namespace App\Listeners;

use App\Events\LockoutEvent;
use Log;

class LockoutListener
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
    public function handle(LockoutEvent $event)
    {
        Log::info('Key locked: ' . $event->key);
    }
}

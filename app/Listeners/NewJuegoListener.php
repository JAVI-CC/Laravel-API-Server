<?php

namespace App\Listeners;

use App\Events\NewJuegoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewJuegoListener
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
     * @param  \App\Events\NewJuegoEvent  $event
     * @return void
     */
    public function handle(NewJuegoEvent $event)
    {
        //
    }
}

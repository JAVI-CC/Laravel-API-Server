<?php

namespace App\Listeners;

use App\Events\UpdateJuegoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateJuegoListener
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
     * @param  \App\Events\UpdateJuegoEvent  $event
     * @return void
     */
    public function handle(UpdateJuegoEvent $event)
    {
        //
    }
}

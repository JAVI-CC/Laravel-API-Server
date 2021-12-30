<?php

namespace App\Listeners;

use App\Events\DeleteJuegoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteJuegoListener
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
     * @param  \App\Events\DeleteJuegoEvent  $event
     * @return void
     */
    public function handle(DeleteJuegoEvent $event)
    {
        //
    }
}

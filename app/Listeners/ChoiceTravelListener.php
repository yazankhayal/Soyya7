<?php

namespace App\Listeners;

use App\Events\ChatEvent;
use App\Events\ChoiceTravelEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChoiceTravelListener
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
     * @param  ChatEvent  $event
     * @return void
     */
    public function handle(ChoiceTravelEvent $event)
    {
        //
    }
}

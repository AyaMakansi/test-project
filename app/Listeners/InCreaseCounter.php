<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InCreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(VideoViewer $event)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        $this->updateViewer($event->video);
    }

    function updateViewer($video){
        $video->viewers=$video->viewers+1;
        $video->save();
    }
}

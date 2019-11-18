<?php

namespace App\Listeners;

use App\Events\DownloadFile;

class DownloadCv
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DownloadFile $event
     * @return void
     */
    public function handle(DownloadFile $event)
    {
        $event->visitLogger->fileDownloaded();
    }
}

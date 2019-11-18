<?php

namespace App\Events;

use App\Contracts\VisitLogger;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DownloadFile
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $visitLogger;

    /**
     * Create a new event instance.
     *
     * @param VisitLogger $visitLogger
     */
    public function __construct(VisitLogger $visitLogger)
    {
        $this->visitLogger = $visitLogger;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

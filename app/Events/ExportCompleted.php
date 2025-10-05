<?php

namespace App\Events;

use App\Models\Export;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportCompleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $export;

    public function __construct(Export $export)
    {
        $this->export = $export;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('exports');
    }

    public function broadcastAs()
    {
        return 'export.completed';
    }
}

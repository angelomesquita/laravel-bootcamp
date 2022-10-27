<?php

namespace App\Events;

use App\Models\Chirp;
use Illuminate\Broadcasting\{Channel, InteractsWithSockets, PrivateChannel};
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChirpCreated
{
    use Dispatchable;
    use InteractsWithSockets; 
    use SerializesModels;

    public function __construct(public Chirp $chirp)
    {
    }

    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}

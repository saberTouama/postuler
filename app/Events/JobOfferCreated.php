<?php

namespace App\Events;
use Illuminate\Support\Facades\Redis;
use App\Models\offre;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class JobOfferCreated  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
     public  $offer;
     public $user_id;
    public function __construct(offre $offre)
    {
     // this is the user who created the offer
        $this->offer = $offre->toArray();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * 
     */
   public function broadcastOn()
{
    // Broadcast to a public channel, accessible by all
    return new Channel('my-channel');
}

public function broadcastWith()
    {
        return ['offer' => $this->offer];
    }
   /* public function broadcastWith()
    {
        return new PrivateChannel('user.' . $this->user_id);
    }*/
    public function broadcastAs(){
        return 'jobOfferCreated';
    }
}

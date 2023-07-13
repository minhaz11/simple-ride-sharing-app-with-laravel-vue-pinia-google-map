<?php

namespace App\Events;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TripCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $trip;
    private $user;

   public function __construct(Trip $trip,User $user)
   {
       $this->trip = $trip;
       $this->user = $user;
   }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn() : array
    {
        return [
            new Channel('drivers')
        ];
    }

    public function broadcastWith() : array
    {
        return [
            'trip'=>$this->trip,
            'user'=>$this->user
        ];
    }
}

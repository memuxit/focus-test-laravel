<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PopulationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $population;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($population)
    {
        //
        $this->population = $population;
    }

    /**
     * Channel
     *
     * @return array|\Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]|string[]
     */
    public function broadcastOn(): array|\Illuminate\Broadcasting\Channel
    {
        return ['population'];
    }

    /**
     * Event
     *
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'population-updated';
    }
}

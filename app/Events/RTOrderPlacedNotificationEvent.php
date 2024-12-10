<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RTOrderPlacedNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orderId;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->orderId = $order->id;
        $this->message = $order->message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return ['order-placed'];
    }

    /**
     * The event's broadcast name.
     * @return string
     */
    public function broadcastAs()
    {
        return 'order-event';
    }
}

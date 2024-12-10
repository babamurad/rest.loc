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
<<<<<<< HEAD
    public function __construct(Order $order)
    {
        $this->orderId = $order->id;
        $this->message = $order->message;
=======
    public function __construct($order)
    {
        $this->order = $order;
>>>>>>> a8e8e3998b59918244e5ca6150febc7d4add159d
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
<<<<<<< HEAD
        return ['order-placed'];
    }

    /**
     * The event's broadcast name.
     * @return string
     */
    public function broadcastAs()
    {
        return 'order-event';
=======
        return [
            new Channel('order-placed', $this->order->id),
        ];
>>>>>>> a8e8e3998b59918244e5ca6150febc7d4add159d
    }
}

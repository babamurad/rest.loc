<?php

namespace App\Events;

use App\Models\Setting;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RTOrderPlacedNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    /**
     * Create a new event instance.
     */
    public function __construct($order = null)
    {
        $this->setConfig();
        $this->order = $order;
    }

    function setConfig()
    {
        $keys = ['app_id', 'app_key', 'app_secret', 'app_cluster'];
        $settings = Setting::whereIn('key', $keys)->get();
        // Преобразование результатов в ассоциативный массив для удобства использования
        $settingsArray = $settings->pluck('value', 'key')->toArray();
        // Использование значений:
        $appId = $settingsArray['app_id'];
        $appKey = $settingsArray['app_key'];
// ... и так далее
        config(['broadcasting.connections.pusher.key' => $settingsArray['app_key']]);
        config(['broadcasting.connections.pusher.app_secret' => $settingsArray['app_secret']]);
        config(['broadcasting.connections.pusher.app_id' => $settingsArray['app_id']]);
        config(['broadcasting.connections.pusher.options.app_cluster' => $settingsArray['app_cluster']]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('order-placed'),
        ];
    }
}

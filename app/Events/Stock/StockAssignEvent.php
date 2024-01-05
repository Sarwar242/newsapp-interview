<?php

namespace App\Events\Stock;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class StockAssignEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public $stock_assign;

    public function __construct($stock_assign)
    {
        $this->stock_assign = $stock_assign;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

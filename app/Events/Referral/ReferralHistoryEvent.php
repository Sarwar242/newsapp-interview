<?php

namespace App\Events\Referral;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReferralHistoryEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public $referralHistory;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($referralHistory)
    {
        $this->referralHistory = $referralHistory;
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

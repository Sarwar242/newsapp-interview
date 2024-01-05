<?php

namespace App\Events\Referral;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReferralCreatedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public $referral;

    public function __construct($referral)
    {
        $this->referral = $referral;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\notifikasi;

class send_notifikasi implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $notifikasi;
    public $detik;

    public function __construct(notifikasi $notifikasi=null)
    {
        // $this->notifikasi = $notifikasi;        
        
    }    

    public function broadcastOn()
    {
        return new PresenceChannel('online');
    }
}

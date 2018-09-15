<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SimpleMail
{
    public $email;
    public $data;
    public $view;
    public $subject;
    public $bcc;

  
    public function __construct($email, $data, $view, $subject, $bcc=array())
    {
        $this->email = $email;
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
        $this->bcc = $bcc;
    }

    public function broadcastOn()
    {
       
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Listeners;

use App\Events\SimpleMail;
use App\Infinity\Services\EmailNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSimpleMail  implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserUpdated  $event
     * @return void
     */
    public function handle(SimpleMail $event)
    {
        $email = $event->email;
        $data = $event->data;
        $view = $event->view;
        $subject = $event->subject;        
        $bcc = $event->bcc;
        EmailNotification::Notified($view, $data, $email, $subject, $bcc);
    }
}

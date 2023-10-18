<?php

namespace App\Listeners;

use App\Events\MessageOrderSuccess;
use App\Http\Controllers\Client\MessageContactController;
use App\Mail\MailToMessageContact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToLeaveMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageOrderSuccess $event): void
    {
        //
        $orders = $event->orders;
        $user = $event->user;

        Mail::to('congmieuso32@gmail.com')->send(new MailToMessageContact($orders, $user));
    }
}

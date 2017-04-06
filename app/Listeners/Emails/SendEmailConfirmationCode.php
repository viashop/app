<?php

namespace Vialoja\Listeners\Emails;

use Vialoja\Events\Emails\EventNotifyNewUserRegistered;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;


/**
 * Class SendEmailConfirmationCode
 * @package Vialoja\Listeners\Emails
 */
class SendEmailConfirmationCode
{

    /**
     * Handle the event.
     *
     * @param  EventNotifyNewUserRegistered  $event
     * @return void
     */
    public function handle(EventNotifyNewUserRegistered $event)
    {

        $subject = Config::get('constants.SUBJECT_CONFIRM_EMAIL');

        $data = [
            'name' => $event->stdClass->new->name,
            'email' => $event->stdClass->new->email,
            'subject' => $subject,
            'token' => $event->stdClass->new->verification_token
        ];

        Mail::send('email.account.confirm-email-register', $data, function ($message) use ($event, $subject){
            $message->from(Config::get('mail.from.contact'))
                ->to($event->stdClass->new->email)
                ->subject($subject);
        });

    }

}

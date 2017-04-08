<?php

namespace Vialoja\Listeners\Emails;

use Vialoja\Events\Emails\EventNotifyResetPassword;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendEmailConfirmationNewPassword
 * @package Vialoja\Listeners\Emails
 */
class SendEmailConfirmationNewPassword
{

    /**
     * Handle the event.
     *
     * @param  EventNotifyResetPassword  $event
     * @return void
     */
    public function handle(EventNotifyResetPassword $event)
    {

        $subject = Config::get('constants.SUBJECT_RESET_PASSWORD');

        $data = [
            'name' => $event->std->new->name,
            'email' => $event->std->new->email,
            'subject' => $subject
        ];

        Mail::send('email.account.password-has-been-reset', $data, function ($message) use ($event, $subject){
            $message->from( Config::get('mail.from.contact'))
                ->to($event->std->new->email)
                ->subject($subject);
        });

    }

}

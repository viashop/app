<?php

namespace Vialoja\Listeners\Emails;

use Vialoja\Events\Emails\EventNotifyNewUserAdminRegistered;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendEmailPasswordNewUserAdmin
 * @package Vialoja\Listeners\Emails
 */
class SendEmailPasswordNewUserAdmin
{
    /**
     * Handle the event.
     *
     * @param EventNotifyNewUserAdminRegistered $event
     */
    public function handle(EventNotifyNewUserAdminRegistered $event)
    {

        $subject = Config::get('constants.SUBJECT_NEW_USER_ADMIN');

        $data = [
            'name' => $event->std->new->name,
            'email' => $event->std->new->email,
            'password' => $event->std->password,
            'subject' => $subject
        ];

        Mail::send('email.control.password.new-password-user-admin', $data, function ($message) use ($event, $subject) {
            $message->from(Config::get('mail.from.contact'))
                ->to($event->std->new->email)
                ->subject($subject);
        });

    }

}

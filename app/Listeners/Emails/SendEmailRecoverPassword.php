<?php

namespace Vialoja\Listeners\Emails;

use Vialoja\Events\Emails\EventNotifyUserRecoverPassword;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendEmailRecoverPassword
 * @package Vialoja\Listeners\Emails
 */
class SendEmailRecoverPassword
{

    /**
     * Handle the event.
     * @param EventNotifyUserRecoverPassword $event
     * @throws Exception
     */
    public function handle(EventNotifyUserRecoverPassword $event)
    {

        $subject = Config::get('constants.SUBJECT_RECOVER_PASSWORD');

        $data = [
            'name' => $event->std->old->name,
            'email' => $event->std->old->email,
            'subject' => $subject,
            'token' => $event->std->new->token,
            'issued' => tools_issued_date(),
        ];

        $send = Mail::send('email.account.recover-password', $data, function ($message) use ($event, $subject){
            $message->from( Config::get('mail.from.contact') )
                ->to($event->std->old->email)
                ->subject($subject);
        });

        if (!is_null($send)) {
            throw new Exception( Config::get('constants.ERROR_PROCCESS') );
        }

    }

}

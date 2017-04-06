<?php

namespace Vialoja\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [


        //+++++++++++++++++++++++++++++++++++++
        //---------- Logs in Database ---------
        //+++++++++++++++++++++++++++++++++++++
        'Vialoja\Events\Logs\User\EventActivityRecordUserLoginInvalid' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserLoginInvalid',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserLoginPasswordInvalid' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordLoginPasswordInvalid',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserLogged' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserLogged',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserRegistered' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserRegistered',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserResetPassword' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordResetPassword',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserTypeAdded' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserTypeAdded',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserTypeChangead' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserTypeChangead',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserTypeRemoved' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserTypeRemoved',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserGenerateNewPassword' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordUserTypeGeneratePassword',
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserRecoverPassword' => [
            'Vialoja\Listeners\Logs\User\ActivityRecordRecoverPassword',
        ],

        //+++++++++++++++++++++++++++++++++++++
        //------------ Send Emails ------------
        //+++++++++++++++++++++++++++++++++++++
        'Vialoja\Events\Emails\EventNotifyNewUserRegistered' => [
            'Vialoja\Listeners\Emails\SendEmailConfirmationCode',
        ],

        'Vialoja\Events\Emails\EventNotifyUserRecoverPassword' => [
            'Vialoja\Listeners\Emails\SendEmailRecoverPassword',
        ],

        'Vialoja\Events\Emails\EventNotifyResetPassword' => [
            'Vialoja\Listeners\Emails\SendEmailConfirmationNewPassword',
        ],

        'Vialoja\Events\Emails\EventNotifyNewUserAdminRegistered' => [
            'Vialoja\Listeners\Emails\SendEmailPasswordNewUserAdmin',
        ],

        'Vialoja\Events\Emails\EventNotifyNewPasswordGenerateUser' => [
            'Vialoja\Listeners\Emails\SendEmailNewPasswordUser',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

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
            \Vialoja\Listeners\Logs\User\ActivityRecordUserLoginInvalid::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserLoginPasswordInvalid' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordLoginPasswordInvalid::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserLogged' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordUserLogged::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserRegistered' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordUserRegistered::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserResetPassword' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordResetPassword::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserTypeAdded' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordUserTypeAdded::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserTypeChangead' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordUserTypeChangead::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserTypeRemoved' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordUserTypeRemoved::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserGenerateNewPassword' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordUserTypeGeneratePassword::class,
        ],

        'Vialoja\Events\Logs\User\EventActivityRecordUserRecoverPassword' => [
            \Vialoja\Listeners\Logs\User\ActivityRecordRecoverPassword::class,
        ],

        //+++++++++++++++++++++++++++++++++++++
        //------------ Send Emails ------------
        //+++++++++++++++++++++++++++++++++++++
        'Vialoja\Events\Emails\EventNotifyNewUserRegistered' => [
            \Vialoja\Listeners\Emails\SendEmailConfirmationCode::class,
        ],

        'Vialoja\Events\Emails\EventNotifyUserRecoverPassword' => [
            \Vialoja\Listeners\Emails\SendEmailRecoverPassword::class,
        ],

        'Vialoja\Events\Emails\EventNotifyResetPassword' => [
            \Vialoja\Listeners\Emails\SendEmailConfirmationNewPassword::class,
        ],

        'Vialoja\Events\Emails\EventNotifyNewUserAdminRegistered' => [
            \Vialoja\Listeners\Emails\SendEmailPasswordNewUserAdmin::class,
        ],

        'Vialoja\Events\Emails\EventNotifyNewPasswordGenerateUser' => [
            \Vialoja\Listeners\Emails\SendEmailNewPasswordUser::class,
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

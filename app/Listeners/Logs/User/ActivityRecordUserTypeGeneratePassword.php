<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserGenerateNewPassword;
use Vialoja\Entities\LogActivityType;
use Vialoja\Entities\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActivityRecordUserTypeGeneratePassword
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordUserTypeGeneratePassword
{
    use RequestHeaders;

    /**
     * @var LogActivityType
     */
    private $type;

    /**
     * @var LogActivityUser
     */
    private $log;

    /**
     * Create the event listener.
     *
     * ActivityRecordUserRegistered constructor.
     * @param LogActivityType $type
     * @param LogActivityUser $log
     */
    public function __construct(LogActivityType $type, LogActivityUser $log)
    {
        $this->type = $type;
        $this->log = $log;
    }

    /**
     * Handle the event.
     *
     * @param  EventActivityRecordUserGenerateNewPassword  $event
     * @return void
     */
    public function handle(EventActivityRecordUserGenerateNewPassword $event)
    {

        $this->log->create([
            'user_id' => Auth::user()->id,
            'reference_new' => json_encode( $event->std->new ),
            'activity_log_type_id' => $this->type->where('name', 'generate-password')->first()->id,
            'reference_table_type' => get_class($event->std->new),
            'request_header' => $this->eventsRequestHeaders(),
        ]);

    }
}

<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserTypeAdded;
use Vialoja\Models\LogActivityType;
use Vialoja\Models\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActivityRecordUserTypeAdded
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordUserTypeAdded
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
     * Handle the event.'
     *
     * @param  EventActivityRecordUserTypeAdded $event
     * @return void
     */
    public function handle(EventActivityRecordUserTypeAdded $event)
    {

        $this->log->create([
            'user_id' => Auth::user()->id,
            'reference_new' => json_encode(isset($event->stdClass->new) ? $event->stdClass->new : null),
            'activity_log_type_id' => $this->type->where('name', 'added')->first()->id,
            'reference_table_type' => get_class(isset($event->stdClass->new) ? $event->stdClass->new : null),
            'request_header' => $this->eventsRequestHeaders(),
        ]);

    }
}

<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserTypeChangead;
use Vialoja\Entities\LogActivityType;
use Vialoja\Entities\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActivityRecordUserTypeChangead
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordUserTypeChangead
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
     * @param  EventActivityRecordUserTypeChangead $event
     * @return void
     */
    public function handle(EventActivityRecordUserTypeChangead $event)
    {

        $this->log->create([
            'user_id' => Auth::user()->id,
            'reference_old' => json_encode(isset($event->std->old) ? $event->std->old : null),
            'reference_new' => json_encode(isset($event->std->new) ? $event->std->new : null),
            'activity_log_type_id' => $this->type->where('name', 'changead')->first()->id,
            'reference_table_type' => get_class(isset($event->std->new) ? $event->std->new : null),
            'request_header' => $this->eventsRequestHeaders(),
        ]);

    }

}

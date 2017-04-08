<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserRecoverPassword;
use Vialoja\Entities\LogActivityType;
use Vialoja\Entities\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;

/**
 * Class ActivityRecordRecoverPassword
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordRecoverPassword
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
     * ActivityRecordRecoverPassword constructor.
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
     * @param  EventActivityRecordUserRecoverPassword  $event
     */
    public function handle(EventActivityRecordUserRecoverPassword $event)
    {

        $this->log->create([
            'user_id' => $event->std->old->id,
            'activity_log_type_id' => $this->type->where('name', 'recover-password')->first()->id,
            'reference_table_type' => get_class($event->std->old),
            'request_header' => $this->eventsRequestHeaders()
        ]);

    }

}
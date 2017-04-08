<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserResetPassword;
use Vialoja\Entities\LogActivityType;
use Vialoja\Entities\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;


/**
 * Class ActivityRecordResetPassword
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordResetPassword
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
     * ActivityRecordResetPassword constructor.
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
     * @param  EventActivityRecordUserResetPassword  $event
     * @return void
     */
    public function handle(EventActivityRecordUserResetPassword $event)
    {

        $this->log->create([
            'user_id' => $event->std->new->id,
            'activity_log_type_id' => $this->type->where('name', 'reset-password')->first()->id,
            'reference_table_type' => get_class($event->std->new),
            'request_header' => $this->eventsRequestHeaders()
        ]);

    }
}
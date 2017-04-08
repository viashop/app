<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserRegistered;
use Vialoja\Entities\LogActivityType;
use Vialoja\Entities\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;

/**
 * Class ActivityRecordUserRegistered
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordUserRegistered
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
     * @param  EventActivityRecordUserRegistered  $event
     * @return void
     */
    public function handle(EventActivityRecordUserRegistered $event)
    {

        $this->log->create([
            'user_id' => $event->std->new->id,
            'activity_log_type_id' => $this->type->where('name', 'registered')->first()->id,
            'reference_table_type' => get_class($event->std->new),
            'request_header' => $this->eventsRequestHeaders()
        ]);

    }
}
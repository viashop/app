<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserLogged;
use Vialoja\Entities\LogActivityType;
use Vialoja\Entities\LogActivityUser;
use Vialoja\Traits\Headers\RequestHeaders;

/**
 * Class ActivityRecordUserLogged
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordUserLogged
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
     * ActivityRecordUserLogged constructor.
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
     * @param  EventActivityRecordUserLogged  $event
     */
    public function handle(EventActivityRecordUserLogged $event)
    {

        $this->log->create([
            'user_id' => $event->stdClass->new->id,
            'activity_log_type_id' => $this->type->where('name', 'logged')->first()->id,
            'reference_table_type' => get_class($event->stdClass->new),
            'request_header' => $this->eventsRequestHeaders()
        ]);

    }

}
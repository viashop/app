<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserLoginInvalid;
use Vialoja\Entities\LogActivityGlobal;
use Vialoja\Entities\LogActivityType;
use Vialoja\Traits\Headers\RequestHeaders;
use Illuminate\Support\Facades\Request;

/**
 * Class ActivityRecordUserLoginInvalid
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordUserLoginInvalid
{

    use RequestHeaders;

    /**
     * @var LogActivityType
     */
    private $type;
    /**
     * @var LogActivityGlobal
     */
    private $log;

    /**
     * Create the event listener.
     *
     * ActivityRecordUserRegistered constructor.
     * @param LogActivityType $type
     * @param LogActivityGlobal $log
     */
    public function __construct(LogActivityType $type, LogActivityGlobal $log)
    {
        $this->type = $type;
        $this->log = $log;
    }
    /**
     * Handle the event.
     *
     * @param  EventActivityRecordUserLoginInvalid $event
     */
    public function handle(EventActivityRecordUserLoginInvalid $event)
    {

        $this->log->create([
            'reference_new' => json_encode( $event->stdClass->new ),
            'activity_log_type_id' => $this->type->where('name', 'global-login-invalid')->first()->id,
            'request_header' => $this->eventsRequestHeaders(),
            'ip' => Request::ip()
        ]);

    }

}

<?php

namespace Vialoja\Listeners\Logs\User;

use Vialoja\Events\Logs\User\EventActivityRecordUserLoginPasswordInvalid;
use Vialoja\Entities\LogActivityGlobal;
use Vialoja\Entities\LogActivityType;
use Vialoja\Traits\Headers\RequestHeaders;
use Illuminate\Support\Facades\Request;


/**
 * Class ActivityRecordLoginPasswordInvalid
 * @package Vialoja\Listeners\Logs\User
 */
class ActivityRecordLoginPasswordInvalid
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
     * @param  EventActivityRecordUserLoginPasswordInvalid  $event
     */
    public function handle(EventActivityRecordUserLoginPasswordInvalid $event)
    {

        $this->log->create([
            'user_id' => $event->std->new->id,
            'reference_new' => json_encode( $event->std->new ),
            'activity_log_type_id' => $this->type->where('name', 'global-login-password-invalid')->first()->id,
            'reference_table_type' => get_class($event->std->new),
            'request_header' => $this->eventsRequestHeaders(),
            'ip' => Request::ip()
        ]);

    }

}

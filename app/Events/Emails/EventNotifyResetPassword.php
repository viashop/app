<?php

namespace Vialoja\Events\Emails;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use stdClass;

/**
 * Class EventNotifyResetPassword
 * @package Vialoja\Events\Emails
 */
class EventNotifyResetPassword
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var stdClass
     */
    public $std;

    /**
     * Create a new event instance.
     *
     * EventNotifyResetPassword constructor.
     * @param stdClass $std
     */
    public function __construct(stdClass $std)
    {
        $this->std = $std;
    }

}

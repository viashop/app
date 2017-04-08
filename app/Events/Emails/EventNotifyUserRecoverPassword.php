<?php

namespace Vialoja\Events\Emails;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use stdClass;

/**
 * Class EventNotifyUserRecoverPassword
 * @package Vialoja\Events\Emails
 */
class EventNotifyUserRecoverPassword
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var stdClass
     */
    public $std;

    /**
     * Create a new event instance.
     *
     * EventNotifyUserRecoverPassword constructor.
     * @param stdClass $std
     */
    public function __construct(stdClass $std)
    {
        $this->std = $std;
    }

}

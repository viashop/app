<?php

namespace Vialoja\Events\Logs\User;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use stdClass;

/**
 * Class EventActivityRecordUserTypeChangead
 * @package Vialoja\Events\Logs\User
 */
class EventActivityRecordUserTypeChangead
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var stdClass
     */
    public $std;

    /**
     * EventActivityRecordUserTypeChangead constructor.
     * @param stdClass $std
     */
    public function __construct(stdClass $std)
    {
        $this->std = $std;
    }
}

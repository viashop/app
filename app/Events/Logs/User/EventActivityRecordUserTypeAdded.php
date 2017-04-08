<?php

namespace Vialoja\Events\Logs\User;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use stdClass;

class EventActivityRecordUserTypeAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleMessagingCreateQueueStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'queue'
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'type' => [
            'required' => true
        ],
        'message' => [
            'required' => true
        ],
        'processed' => [
            'required' => false
        ],
        'processed_at' => [
            'required' => false
        ],
        'result' => [
            'required' => false
        ],
    ];

}

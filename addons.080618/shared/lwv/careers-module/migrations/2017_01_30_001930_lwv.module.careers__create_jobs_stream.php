<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleCareersCreateJobsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'jobs'
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'required' => true
        ],
        'type' => [
            'required' => true
        ],
        'department' => [
            'required' => true
        ],
        'job_title' => [
            'required' => true
        ],
        'summary' => [
            'required' => true
        ],
        'body' => [
            'required' => true
        ],
        'active' => [
            'required' => false
        ],
    ];

}

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleCareersCreateApplicantsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'applicants'
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'required' => true
        ],
        'email' => [
            'required' => true
        ],
        'phone' => [
            'required' => true
        ],
        'cover_letter' => [
            'required' => false
        ],
        'job_id' => [
            'required' => true
        ],
        'attachments' => [
            'required' => false
        ],
    ];

}

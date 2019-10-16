<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDataCreateEducationStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'education',
        'title_column' => 'name',
        'translatable' => false,
        'sortable' => true
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
        'class_type' => [
            'required' => true
        ],
        'class_category' => [
            'required' => true
        ],
        'clubhouse' => [
            'required' => true
        ],
        'schedule' => [
            'required' => true
        ],
        'cost' => [
            'required' => false
        ],
    ];

}

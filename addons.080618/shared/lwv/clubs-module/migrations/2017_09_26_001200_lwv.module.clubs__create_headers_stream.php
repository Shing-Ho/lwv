<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreateHeadersStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'headers',
        'translatable' => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'image' => [
            'translatable' => false,
            'required' => true,
        ],
        'image_layout' => [
            'required' => true,
            'translatable' => false,
        ],
        'image_position' => [
            'required' => true,
            'translatable' => false,
        ],
    ];

}

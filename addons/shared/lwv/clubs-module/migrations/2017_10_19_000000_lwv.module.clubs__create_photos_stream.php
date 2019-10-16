<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreatePhotosStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'photos',
        'translatable' => false,
        'sortable' => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'image' => [
            'required' => true
        ],
        'description' => [
            'required' => false
        ],
        'club' => [
            'required' => true
        ],

    ];

}

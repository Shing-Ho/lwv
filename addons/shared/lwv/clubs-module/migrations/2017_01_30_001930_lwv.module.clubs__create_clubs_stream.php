<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreateClubsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'clubs',
        'title_column' => 'title',
        'translatable' => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'required' => true,
            'unique' => true
        ],
        'slug' => [
            'required' => true,
            'unique' => true
        ],
        'category' => [
            'required' => true
        ],
        'intro' => [
            'required' => true
        ],
        'contact' => [
            'required' => false
        ],
        'hosting' => [
            'required' => true
        ],
        'url' => [
            'required' => false
        ],
        'admins' => [
            'required' => false
        ],
    ];

}

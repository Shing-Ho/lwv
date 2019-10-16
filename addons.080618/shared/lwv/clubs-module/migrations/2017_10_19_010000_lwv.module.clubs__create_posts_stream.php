<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreatePostsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'posts',
        'title_column' => 'title',
        'translatable' => false,
        'trashable'    => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'required'     => true
        ],
        'slug' => [
            'required' => true,
            'unique'   => true
        ],
        'post_type' => [
            'required' => true
        ],
        'image' => [
            'required' => false
        ],
        'teaser' => [
            'required' => false
        ],
        'body' => [
            'required' => true
        ],
        'publish_at' => [
            'required' => true
        ],
        'publish_until',
        'enabled',
        'club' => [
            'required' => true
        ],
    ];

}

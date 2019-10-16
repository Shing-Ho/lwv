<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class LwvModuleNewsCreatePostsStream
 */
class LwvModuleNewsCreatePostsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'posts',
        'title_column' => 'title',
        'translatable' => true,
        'trashable'    => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'str_id'           => [
            'required' => true,
            'unique'   => true
        ],
        'title'            => [
            'translatable' => true,
            'required'     => true
        ],
        'summary'          => [
            'translatable' => true
        ],
        'slug'             => [
            'required' => true,
            'unique'   => true
        ],
        'type'             => [
            'required' => true
        ],
        'publish_at'       => [
            'required' => true
        ],
        'publish_until',
        'entry'            => [
            'required' => true
        ],
        'meta_title'       => [
            'translatable' => true
        ],
        'meta_description' => [
            'translatable' => true
        ],
        'meta_keywords'    => [
            'translatable' => true
        ],
        'category',
        'featured',
        'enabled',
        'tags'
    ];

}

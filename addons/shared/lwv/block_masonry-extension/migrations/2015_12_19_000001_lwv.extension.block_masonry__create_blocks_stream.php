<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockMasonryCreateBlocksStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'blocks',
        'title_column' => 'title',
        'translatable' => true,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'translatable' => false,
            'required' => true
        ],
        'block_id' => [
            'translatable' => false,
            'required' => true
        ],
        'layout' => [
            'required' => true,
            'translatable' => false,
        ],
        'images' => [
            'required' => false,
            'translatable' => false,
        ],
        'body' => [
            'translatable' => true,
            'required' => false,
        ],
        'filters' => [
            'translatable' => true,
            'required' => false,
        ],
        'filter_default' => [
            'translatable' => false,
            'required' => false,
        ],
        'page' => [
            'translatable' => false,
            'required' => true,
        ],
        'weight' => [
            'translatable' => false,
            'required' => true
        ],
        'css' => [
            'translatable' => false,
            'required' => false
        ],
        'cache_enabled' => [
            'translatable' => false,
            'required' => false
        ],
    ];
}


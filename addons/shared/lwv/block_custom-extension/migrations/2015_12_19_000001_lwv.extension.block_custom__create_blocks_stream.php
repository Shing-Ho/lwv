<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockCustomCreateBlocksStream extends Migration
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
        'sortable' => true
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
        'body' => [
            'translatable' => true,
            'required' => true
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


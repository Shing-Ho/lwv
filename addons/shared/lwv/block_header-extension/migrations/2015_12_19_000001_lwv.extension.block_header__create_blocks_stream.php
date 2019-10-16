<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockHeaderCreateBlocksStream extends Migration
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
        'layout' => [
            'required' => true,
            'translatable' => false,
        ],
        'menu' => [
            'required' => false,
            'translatable' => false,
        ],
        'images' => [
            'required' => false,
            'translatable' => false,
        ],
        'page' => [
            'translatable' => false,
            'required' => true,
        ],
        'weight' => [
            'translatable' => false,
            'required' => true
        ],
    ];
}


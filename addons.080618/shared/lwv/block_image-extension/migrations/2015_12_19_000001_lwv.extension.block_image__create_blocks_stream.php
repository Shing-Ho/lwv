<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockImageCreateBlocksStream extends Migration
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
        'layout' => [
            'translatable' => false,
            'required' => true
        ],
        'image' => [
            'translatable' => false,
            'required' => false
        ],
        'animation' => [
            'translatable' => false,
            'required' => false
        ],
        'body' => [
            'translatable' => true,
            'required' => false
        ],
        'alignment' => [
            'translatable' => false,
            'required' => false
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


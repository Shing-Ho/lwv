<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockSliderCreateBlocksStream extends Migration
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
        'animation' => [
            'required' => false,
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
        'width' => [
            'translatable' => false,
            'required' => true,
        ],
        'autoscroll' => [
            'translatable' => false,
            'required' => true,
        ],
        'arrows' => [
            'translatable' => false,
            'required' => true,
        ],
        'dots' => [
            'translatable' => false,
            'required' => true,
        ],
        'infinite' => [
            'translatable' => false,
            'required' => true,
        ],
        'widescreen' => [
            'translatable' => false,
            'required' => true,
        ],
        'desktop' => [
            'translatable' => false,
            'required' => true,
        ],
        'tablet' => [
            'translatable' => false,
            'required' => true,
        ],
        'phone' => [
            'translatable' => false,
            'required' => true,
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


<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockTestimonialCreateBlocksStream extends Migration
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
        'category' => [
            'translatable' => false,
            'required' => true
        ],
        'order' => [
            'translatable' => false,
            'required' => true
        ],
        'count' => [
            'translatable' => false,
            'required' => true
        ],
        'background' => [
            'translatable' => false,
            'required' => true
        ],
        'link_url' => [
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


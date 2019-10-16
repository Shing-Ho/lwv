<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockHeaderCreateImagesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'images',
        'translatable' => true,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'image_layout' => [
            'required' => true,
            'translatable' => false,
        ],
        'image_position' => [
            'required' => true,
            'translatable' => false,
        ],
        'image' => [
            'translatable' => false,
            'required' => true,
        ],
        'overlay' => [
            'translatable' => true,
            'required' => false,
        ],
        'block' => [
            'translatable' => false,
            'required' => true,
        ],
        'weight' => [
            'translatable' => false,
            'required' => true
        ],
    ];

}

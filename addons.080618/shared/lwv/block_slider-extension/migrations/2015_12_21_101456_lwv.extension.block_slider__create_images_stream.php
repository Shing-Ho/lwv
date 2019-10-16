<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockSliderCreateImagesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'images',
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
        'image_layout' => [
            'required' => true,
            'translatable' => false,
        ],
        'image' => [
            'required' => true,
        ],
        'modal_image' => [
            'translatable' => false,
            'required' => false,
        ],
        'overlay' => [
            'translatable' => true,
            'required' => false,
        ],
        'modal_body' => [
            'translatable' => true,
            'required' => false,
        ],
        'body' => [
            'translatable' => true,
            'required' => false,
        ],
        'link_url' => [
            'translatable' => true,
            'required' => false,
        ],
        'link_target' => [
            'translatable' => false,
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

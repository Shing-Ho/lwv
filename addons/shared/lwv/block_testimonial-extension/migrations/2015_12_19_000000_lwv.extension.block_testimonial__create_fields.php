<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockTestimonialCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        // Fields
        'title' => 'anomaly.field_type.text',
        'block_id' => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'type'    => '-',
                'slugify' => 'title'
            ]
        ],
        'category' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'handler' => 'Lwv\DataModule\Testimonial\TestimonialCategoryOptions@handle'
            ]
        ],
        'order' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'newest' => 'Newest',
                    'random' => 'Random',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'count' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 0,
                'max'           => 8,
                'step'          => 1,
                'default_value' => 3
            ]
        ],
        'link_url' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'background' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_testimonial_images'],
            ]
        ],
        'page' => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'css' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'css',
                'theme'  => 'monokai',
                'height' => 300
            ]
        ],
        'weight' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0
            ]
        ],
    ];

}

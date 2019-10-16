<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockHeaderCreateFields extends Migration
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
        'layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'static' => 'Static Image',
                    'slideshow' => 'Slideshow',
                ],
                'default_value' => '3',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'menu' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'mode' => 'dropdown',
                'handler' => 'Lwv\BlockHeaderExtension\Block\MenuOptions@handle'
            ]
        ],
        'images' => [
            'type'   => 'lwv.field_type.block_images',
        ],
        'page' => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'default_value' => 0,
            ]
        ],
        'weight' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'default_value' => 0
            ]
        ],
        'cache_enabled' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'mode' => 'checkbox',
                'label' => 'Enable Caching',
                'default_value' => true,

            ]
        ],
        // Header Image specific fields
        'image_layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'full' => 'Full Screen',
                    '60' => '60%',
                    '40' => '40%',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'image_position' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'center' => 'Center',
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'image' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_header_images'],
            ]
        ],
        'overlay' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 200
            ]
        ],
        'block' => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'default_value' => 0,
            ]
        ],
    ];
}

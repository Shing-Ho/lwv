<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockImageCreateFields extends Migration
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
        'layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'left' => 'Left',
                    'right' => 'Right',
                    'banner' => 'Banner (Text Below)',
                    'bannerbg' => 'Banner (Text Overlay)',
                    'custom' => 'Custom',
                ],
                'default_value' => 'left',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        "image" => [
            "type"   => "anomaly.field_type.file",
            "config" => [
                'folders'  => ['block_images'],
            ]
        ],
        'animation' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'none' => 'None',
                    'fade' => 'Fade In',
                    'right' => 'Slide In (Right)',
                    'left' => 'Slide In (Left)',
                    'up' => 'Slide In (Up)',
                ],
                'default_value' => 'none',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'body' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 300
            ]
        ],
        'alignment' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'center' => 'Center',
                    'top' => 'Top',
                ],
                'default_value' => 'center',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
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
        'cache_enabled' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'mode' => 'checkbox',
                'label' => 'Enable Caching',
                'default_value' => true,

            ]
        ],
    ];

}

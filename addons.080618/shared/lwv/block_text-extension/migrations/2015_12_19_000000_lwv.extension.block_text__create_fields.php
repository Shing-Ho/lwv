<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockTextCreateFields extends Migration
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
                    'padded' => 'Padded',
                    'full_width' => 'Full Width',
                ],
                'default_value' => 'full_width',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'alignment' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right',
                ],
                'default_value' => 'left',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'block_title' => 'anomaly.field_type.text',
        'body' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 300
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

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockGalleryCreateFields extends Migration
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
                    '1' => 'One Column',
                    '2' => 'Two Column',
                    '3' => 'Three Column',
                    '4' => 'Four Column',
                ],
                'default_value' => '3',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
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
        'images' => [
            'type'   => 'lwv.field_type.block_images',
        ],
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
        // Gallery Image specific fields
        'image_layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'photo' => 'Simple Image',
                    'lightbox' => 'Lightbox Image',
                    'video' => 'Video',
                    'linked' => 'Linked Image',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'image' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_gallery_images'],
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
        'overlay_type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'fixed' => 'Fixed',
                    'animated' => 'Animated',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'overlay_position' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'top' => 'Top',
                    'bottom' => 'Bottom',
                    'left' => 'Left',
                    'right' => 'Right',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'overlay_background' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'yellow' => 'Yellow',
                    'semiyellow' => 'Semitransparent Yellow',
                    'blue' => 'Blue',
                    'semiblue' => 'Semitransparent Blue',
                    'orange' => 'Orange',
                    'semiorange' => 'Semitransparent Orange',
                    'purple' => 'Purple',
                    'semipurple' => 'Semitransparent Purple',
                    'green' => 'Green',
                    'semigreen' => 'Semitransparent Green',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'block' => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'default_value' => 0,
            ]
        ],
        // Image layout specific fields (Video & Linked Photo)
        'link_url' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'link_target' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    '_blank' => 'New Window',
                    '_self' => 'Current Window',
                ],
                'default_value' => '_blank',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
    ];
}

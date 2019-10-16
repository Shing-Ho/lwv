<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockSliderCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    /**
     * The addon fields.
     *
     * @var arrayS
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
        'width' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'container' => 'Container Width',
                    'browser' => 'Browser Width',
                ],
                'default_value' => 'container',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'autoscroll' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 0,
                'max'           => 20000,
                'step'          => 1000,
                'default_value' => 0
            ]
        ],
        'arrows' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
                'default_value' => 'yes',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'dots' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
                'default_value' => 'yes',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'infinite' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
                'default_value' => 'yes',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'widescreen' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 1,
                'max'           => 6,
                'step'          => 1,
                'default_value' => 4
            ]
        ],
        'desktop' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 1,
                'max'           => 6,
                'step'          => 1,
                'default_value' => 3
            ]
        ],
        'tablet' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 1,
                'max'           => 6,
                'step'          => 1,
                'default_value' => 2
            ]
        ],
        'phone' => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 1,
                'max'           => 6,
                'step'          => 1,
                'default_value' => 1
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
        // Slider Image specific fields
        'image_layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'photo' => 'Simple Image',
                    'lightbox' => 'Lightbox Image',
                    'video' => 'Video',
                    'linked' => 'Linked Image',
                    'content' => 'Lightbox Content',
                    'text' => 'Text Overlay',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'image' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_slider_images'],
            ]
        ],
        'modal_image' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_slider_images'],
            ]
        ],
        'modal_body' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 300
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

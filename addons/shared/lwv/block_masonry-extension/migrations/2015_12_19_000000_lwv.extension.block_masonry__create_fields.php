<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvExtensionBlockMasonryCreateFields extends Migration
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
                    'masonry' => 'Masonry',
                    'fitRows' => 'Fit Rows',
                    'vertical' => 'Vertical',
                ],
                'default_value' => 'masonry',
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
        'filters' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 4,
            ],
        ],
        'filter_default' => 'anomaly.field_type.text',
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
        // Masonry Image specific fields
        'image_layout' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'photo' => 'Simple Image',
                    'lightbox' => 'Lightbox Image',
                    'content' => 'Lightbox Content',
                    'video' => 'Video',
                    'linked' => 'Linked Image',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'size' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'l' => 'Large',
                    'm' => 'Medium',
                    's' => 'Small',
                ],
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'image' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_masonry_images'],
            ]
        ],
        'modal_image' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['block_masonry_images'],
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
        'tags' => [
            'type'   => 'anomaly.field_type.checkboxes',
            'config' => [
                'options' => [],
                'mode' => 'checkboxes',
                'handler' => 'Lwv\BlockMasonryExtension\Block\BlockFilterOptions@handle'
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

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class LwvModuleNewsCreateFields
 */
class LwvModuleNewsCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id'           => 'anomaly.field_type.text',
        'name'             => 'anomaly.field_type.text',
        'title'            => 'anomaly.field_type.text',
        'slug'             => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'title',
                'type'    => '-'
            ]
        ],
        'type'             => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\NewsModule\Type\TypeModel'
            ]
        ],
        'tags'             => 'anomaly.field_type.tags',
        'summary'          => 'anomaly.field_type.textarea',
        'description'      => 'anomaly.field_type.textarea',
        'publish_at'       => 'anomaly.field_type.datetime',
        'publish_until'    => 'anomaly.field_type.datetime',
        'entry'            => 'anomaly.field_type.polymorphic',
        'category'         => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\NewsModule\Category\CategoryModel'
            ]
        ],
        'enabled'          => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false
            ]
        ],
        'featured'         => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false
            ]
        ],
        'intro' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 300
            ]
        ],
        'footer' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 300
            ]
        ],
        'meta_title'       => 'anomaly.field_type.text',
        'meta_description' => 'anomaly.field_type.textarea',
        'meta_keywords'    => 'anomaly.field_type.tags'
    ];

}

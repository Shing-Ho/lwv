<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'title' => 'anomaly.field_type.text',
        'slug'             => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'title',
                'type'    => '-'
            ]
        ],
        'enabled' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false
            ]
        ],
        'category' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'general' => 'General Interest',
                    'arts' => 'Arts & Crafts',
                    'games' => 'Cards & Games',
                    'cultural' => 'Cultural',
                    'dance' => 'Dance',
                    'health' => 'Health & Wellness',
                    'performing' => 'Performing Arts',
                    'political' => 'Political',
                    'support' => 'Support Groups',
                    'tech' => 'Science & Technology',
                    'fitness' => 'Sports & Fitness',
                    'religious' => 'Religious & Spiritual'
                ],
                'default_value' => 'general',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'intro' => [
            'type'   => 'anomaly.field_type.textarea'
        ],
        'contact' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 200
            ]
        ],
        'hosting' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'none' => 'None',
                    'internal' => 'Internal Website',
                    'external' => 'External Website'
                ],
                'default_value' => 'none',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'url' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'admins' => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related'        => '\Anomaly\UsersModule\User\UserModel',
                'mode'           => 'lookup',
                'handler'        => '\Anomaly\MultipleFieldType\Handler\Related@handle'
            ]
        ],
        'logo' => [
            'type'   => 'anomaly.field_type.file',
            'config' => [
                'folders'  => ['clubs_images'],
            ]
        ],
        'web_intro' => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'config' => [
                "height"        => 300,
                'buttons' => ["format","bold", "italic", "underline", "lists","horizontalrule","link"],
                'plugins' => ["video","alignment","fullscreen"],
            ],
        ],
        'web_contact' => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'config' => [
                "height"        => 300,
                'buttons' => ["bold", "italic", "underline", "lists", "link"],
                'plugins' => ["fullscreen"],
            ],
        ],
        'web_body' => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'config' => [
                "height"        => 300,
                'buttons' => ["format","bold", "italic", "underline", "lists","horizontalrule","link"],
                'plugins' => ["video","alignment","fullscreen"],
            ],
        ],
        'club' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\ClubsModule\Club\ClubModel',
            ],
        ],
        'header' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\ClubsModule\Header\HeaderModel',
                'mode' => 'lookup',
                'lookup_table' => 'Lwv\ClubsModule\Header\Table\LookupTableBuilder',
                'value_table' => 'Lwv\ClubsModule\Header\Table\ValueTableBuilder',
            ],
        ],
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
        'description' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 2,
            ],
        ],
        'teaser' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 2,
            ],
        ],
        'body' => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'config' => [
                "height"        => 300,
                'buttons' => ["format","bold", "italic", "underline", "lists","horizontalrule","link"],
                'plugins' => ["video","alignment","fullscreen"],
            ],
        ],
        'publish_at'       => [
            'type' => 'anomaly.field_type.datetime',
            'config' => [
                'default' => 'now'
            ]
        ],
        'publish_until'    => 'anomaly.field_type.datetime',
        'document' => [
            "type"   => "anomaly.field_type.file",
            "config" => [
                'folders'  => ['clubs_documents'],
                'mode'  => 'upload',
            ]
        ],
        'image' => [
            "type"   => "anomaly.field_type.file",
            "config" => [
                'folders'  => ['clubs_images'],
                'mode'  => 'upload',
            ]
        ],
        'post_type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'news' => 'News',
                    'events' => 'Events'
                ],
                'default_value' => 'news',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        'private' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
                "on_text"       => "PRIVATE",
                "off_text"      => "PUBLIC",
            ],
        ],
    ];
}

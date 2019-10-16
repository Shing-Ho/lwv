<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDocumentsCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        // Fields
        'title' => [
            'type'   => 'anomaly.field_type.text',
        ],
        'slug' => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'type'    => '-',
                'slugify' => 'title'
            ]
        ],
        // Folder fields
        'parent' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\DocumentsModule\Folder\FolderModel',
            ],
        ],
        'enabled' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'searchable' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'path'             => 'anomaly.field_type.text',
        // Document fields
        'folder' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\DocumentsModule\Folder\FolderModel',
            ],
        ],
        'description' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 2,
            ],
        ],
        'document' => [
            "type"   => "anomaly.field_type.file",
            "config" => [
                'folders'  => ['documents'],
            ]
        ],
        'private' => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
                "on_text"       => "PRIVATE",
                "off_text"      => "PUBLIC",
            ],
        ],
        'folder_type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    'other' => 'Other',
                    'minutes' => 'Minutes',
                ],
                'default_value' => 'other',
                'handler' => 'Anomaly\SelectFieldType\SelectFieldTypeOptions@handle'
            ]
        ],
        "granicus" => [
            "type"   => "anomaly.field_type.url",
        ],
        // Resolution fields
        'number' => [
            'type' => 'anomaly.field_type.text',
            'config' => [
                'max' => 10,
            ],
        ],
        'summary' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'max' => 500
            ],
        ],
        //'passed' => [
        //    'type'   => 'anomaly.field_type.boolean',
        //    "config" => [
        //        "default_value" => true,
        //        "on_text"       => "PASSED",
        //        "off_text"      => "FAILED",
        //    ]
        //],
        'minutes' => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Lwv\DocumentsModule\Document\DocumentModel',
            ],
        ],
    ];

}

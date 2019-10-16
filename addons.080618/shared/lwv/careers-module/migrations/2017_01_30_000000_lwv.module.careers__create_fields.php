<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleCareersCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'title' => 'anomaly.field_type.text',
        // Job
        'type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'handler' => 'Lwv\CareersModule\Field\TypeOptions@handle'
            ]
        ],
        'department' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'handler' => 'Lwv\CareersModule\Field\DepartmentOptions@handle'
            ]
        ],
        'job_title' => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'max'           => 40,
            ]
        ],
        'summary' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 3,
                'max'           => 500,
            ]
        ],
        'body' => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'config' => [
                'buttons' => ["bold", "italic", "underline", "lists"],
                'plugins' => [],
                'height' => 300,
            ],
        ],
        'active' => [
            "type"   => "anomaly.field_type.boolean",
            "config" => [
                "default_value" => false,
                "mode"          => "switch",
            ]
        ],
        // Applicant
        'name' => 'anomaly.field_type.text',
        'email' => 'anomaly.field_type.email',
        'phone' => 'anomaly.field_type.text',
        'website' => 'anomaly.field_type.text',
        'cover_letter' => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'rows'          => 5,
                'max'           => 2048,
            ]
        ],
        'attachments' => [
            'type'   => 'anomaly.field_type.files',
            'config' => [
                'folders'  => ['careers_attachments'],
                'max'   => 4
            ]
        ],
        'job_id' => 'anomaly.field_type.integer',
    ];

}

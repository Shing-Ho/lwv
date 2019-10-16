<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleMessagingCreateMessagingFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'type' => 'anomaly.field_type.text',
        'message' => 'anomaly.field_type.textarea',
        'processed' => 'anomaly.field_type.boolean',
        'processed_at' => [
            'type'   => 'anomaly.field_type.datetime',
            'config' => [
                'mode'        => 'datetime',
            ]
        ],
        'result' => 'anomaly.field_type.text'
    ];

}

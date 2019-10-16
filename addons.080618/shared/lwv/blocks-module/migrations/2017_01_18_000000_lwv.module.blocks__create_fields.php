<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleBlocksCreateFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        // Fields
        'block_type' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [],
                'mode' => 'dropdown',
                'handler' => 'Lwv\BlocksModule\Template\BlockTypeOptions@handle'
            ]
        ],
        'template' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'   => 'twig',
                'theme'  => 'monokai',
                'height' => 500
            ]
        ],
    ];

}

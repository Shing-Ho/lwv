<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleBlocksCreateTemplatesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'templates',
        'title_column' => 'block_type',
        'translatable' => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'block_type' => [
            'required' => true,
            'unique' => true
        ],
        'template' => [
            'required' => true
        ]
    ];

}

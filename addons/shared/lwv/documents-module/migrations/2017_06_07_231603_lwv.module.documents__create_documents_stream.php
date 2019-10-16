<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDocumentsCreateDocumentsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'documents',
        'title_column' => 'title',
        'translatable' => false,
        'sortable' => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title' => [
            'required' => true
        ],
        'folder' => [
            'required' => true
        ],
        'description' => [
            'required' => false
        ],
        'document' => [
            'required' => true
        ],
        'granicus' => [
            'required' => false
        ],
        'private' => [
            'required' => false
        ],
    ];

}

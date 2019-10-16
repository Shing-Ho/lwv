<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreateDocumentsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'documents',
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
        'description' => [
            'required' => false
        ],
        'document' => [
            'required' => true
        ],
        'private' => [
            'required' => false
        ],
        'club' => [
            'required' => true
        ],
    ];

}

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDocumentsCreateFoldersStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'folders',
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
        'slug' => [
            'required' => true
        ],
        'folder_type' => [
            'required' => true
        ],
        'description' => [
            'required' => false
        ],
        'path' => [
            'required' => false
        ],
        'parent' => [
            'required' => false
        ],
        'enabled' => [
            'required' => false
        ],
        'searchable' => [
            'required' => false
        ],
    ];
}

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDocumentsCreateResolutionsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'resolutions',
        'title_column' => 'number',
        'translatable' => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'number' => [
            'required' => true
        ],
        'summary' => [
            'required' => false
        ],
        //'passed' => [
        //    'required' => false
        //],
        'minutes' => [
            'required' => true
        ],
    ];

}

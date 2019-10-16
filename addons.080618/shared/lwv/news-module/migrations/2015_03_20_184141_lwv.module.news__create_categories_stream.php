<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class LwvModuleNewsCreateCategoriesStream
 */
class LwvModuleNewsCreateCategoriesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'categories',
        'title_column' => 'name',
        'translatable' => true,
        'trashable'    => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name'        => [
            'translatable' => true,
            'required'     => true,
            'unique'       => true
        ],
        'slug'        => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name'
            ]
        ],
        'description' => [
            'translatable' => true
        ],
        'intro' => [
            'translatable' => true
        ],
        'footer' => [
            'translatable' => true
        ]
    ];

}

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class LwvModuleNewsCreateTypesStream
 */
class LwvModuleNewsCreateTypesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'types',
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
        'name'         => [
            'required' => true,
            'unique'   => true
        ],
        'slug'         => [
            'required' => true,
            'unique'   => true,
            'config'   => [
                'slugify' => 'name',
                'type'    => '_'
            ]
        ],
        'description'
    ];

}

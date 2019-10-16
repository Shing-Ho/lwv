<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDataCreateFloorplansStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'floorplans',
        'title_column' => 'name',
        'translatable' => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'required' => true,
            'unique' => true
        ],
        'mutual' => [
            'required' => true
        ],
        'size' => [
            'required' => true
        ],
        'bedrooms' => [
            'required' => true
        ],
        'baths' => [
            'required' => true
        ],
        'atrium' => [
            'required' => true
        ],
        'laundry' => [
            'required' => true
        ],
        'fireplace' => [
            'required' => true
        ],
        'parking' => [
            'required' => true
        ],
        'parking_size' => [
            'required' => true
        ],
        'floorplan' => [
            'required' => false
        ],
    ];

}

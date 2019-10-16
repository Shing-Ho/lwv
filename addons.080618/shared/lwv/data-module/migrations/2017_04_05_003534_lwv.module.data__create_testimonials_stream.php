<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDataCreateTestimonialsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'testimonials',
        'title_column' => 'title',
        'translatable' => false,
        'sortable' => false
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
        'testimonial_category' => [
            'required' => true
        ],
        'testimonial_name' => [
            'required' => true
        ],
        'testimonial' => [
            'required' => true
        ],
        'approved' => [
            'required' => false
        ],
    ];
}

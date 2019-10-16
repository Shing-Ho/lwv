<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDataCreateContactsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'contacts',
        'title_column' => 'name',
        'translatable' => false,
        'sortable' => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'required' => true
        ],
        'contact_category' => [
            'required' => true
        ],
        'phone' => [
            'required' => false
        ],
        'email' => [
            'required' => false
        ],
    ];

}

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleClubsCreateWebsitesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'websites',
        'translatable' => false,
        'sortable' => false
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'header' => [
            'required' => true
        ],
        'logo' => [
            'required' => false
        ],
        'web_intro' => [
            'required' => false
        ],
        'web_contact' => [
            'required' => false
        ],
        'web_body' => [
            'required' => false
        ],
        'enabled' => [
            'required' => false
        ],
        'club' => [
            'required' => true
        ],

    ];

}

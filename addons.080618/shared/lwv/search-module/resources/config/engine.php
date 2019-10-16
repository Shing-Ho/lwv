<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Search Driver
    |--------------------------------------------------------------------------
    */

    'default'       => 'zend',

    /*
    |--------------------------------------------------------------------------
    | Default Index
    |--------------------------------------------------------------------------
    */

    'default_index' => 'default',

    /*
    |--------------------------------------------------------------------------
    | Search Results Limig
    |--------------------------------------------------------------------------
    */

    'limit' => '50',

    /*
    |--------------------------------------------------------------------------
    | Search Connections
    |--------------------------------------------------------------------------
    */

    'connections'   => [
        'zend'          => [
            'driver' => 'zend',
            'path'   => 'storage::search/zend'
        ],
    ]
];

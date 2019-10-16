<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Quality
    |--------------------------------------------------------------------------
    |
    | Specify the default image quality.
    |
    */

    'quality' => env('IMAGE_QUALITY', 80),

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    | Add additional path prefixes for the image manager here. You may also
    | add prefixes for domains like a CDN.
    |
    | Later you can access images in the path like:
    |
    | $image->make('example::path/to/image.jpg');
    |
    */

    'paths' => [
        'tmp' => '/tmp',
    ],

    /*
    |--------------------------------------------------------------------------
    | Macros
    |--------------------------------------------------------------------------
    |
    | We don't want any macros run against images automatically on a responsive site!
    |
    */

    'macros' => [],
];

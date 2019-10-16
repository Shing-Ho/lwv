<?php

return [
    'title'       => [
        'name' => 'Title',
        'instructions' => 'Title must be unique',
    ],
    'block_id'        => [
        'name' => 'Block ID',
        'instructions' => 'Unique ID for this block on the page.  Used for anchor tags and targeting the block with CSS',
    ],
    'cache_enabled'        => [
        'name' => 'Cache Control',
        'instructions' => 'Only disable caching for blocks that contain dynamic content such as plugins',
    ],
    'body' => [
        'name' => 'Body',
        'instructions' => 'Enter body copy in HTML or TWIG format'
    ],
    'page' => [
        'name' => 'Page'
    ],
    'css'    => [ 'name' => 'CSS' ],
];

<?php

return [
    'title'       => [
        'name' => 'Title',
        'instructions' => 'Title must be unique',
    ],
    'layout'       => [
        'name' => 'Header Layout',
        'instructions' => 'Choose the layout for this header',
    ],
    'menu'       => [
        'name' => 'Header Menu',
        'instructions' => 'Choose a menu to display in the header',
    ],
    'images'       => [
        'name' => 'Header Images',
    ],
    'cache_enabled'        => [
        'name' => 'Cache Control',
        'instructions' => 'Only disable caching for blocks that contain dynamic content such as plugins',
    ],
    'image_layout'       => [
        'name' => 'Header Style',
        'instructions' => 'Headers are automatically resized based on a percentage of the users screen height. Select a style for this header.',
    ],
    'image_position'       => [
        'name' => 'Header Position',
        'instructions' => 'How should the header background be positioned?',
    ],
    'image'       => [
        'name' => 'Image',
    ],
    'overlay'       => [
        'name' => 'Image Overlay',
        'instructions' => 'Enter header copy to overlay on top of this header image',
        'warning' => 'HTML / Twig Format'
    ],
    'block' => [
        'name' => 'Block'
    ],
    'page' => [
        'name' => 'Page'
    ],
];

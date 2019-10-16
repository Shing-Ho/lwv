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
    'layout'       => [
        'name' => 'Masonry Layout',
        'instructions' => 'Choose the layout for this masonry gallery',
    ],
    'images'       => [
        'name' => 'Masonry Images',
    ],
    'body' => [
        'name' => 'Body',
        'instructions' => 'Enter body copy in HTML or TWIG format'
    ],
    'filters' => [
        'name' => 'Filters',
        'placeholder' => 'filter|Filter',
        'instructions' => 'Optional: Enter a list of masonry filters to allow gallery images to be filtered by category.  Format should be selector|name.  Selectors must match tags specified in masonry images.  Enter one selector / value pair per line',
    ],
    'filter_default' => [
        'name' => 'Default Filter',
        'placeholder' => 'filter',
        'instructions' => 'Optional: Enter a default filter to apply to the masonry block when it is first displayed',
    ],
    'cache_enabled'        => [
        'name' => 'Cache Control',
        'instructions' => 'Only disable caching for blocks that contain dynamic content such as plugins',
    ],
    'image_layout'       => [
        'name' => 'Image Layout',
        'instructions' => 'Choose the layout for this masonry image',
    ],
    'image'       => [
        'name' => 'Image',
    ],
    'modal_image'       => [
        'name' => 'Modal Image',
        'instructions' => 'Select an image to display in the lightbox modal window.  If none is supplied the masonry image will be used.'
    ],
    'overlay'       => [
        'name' => 'Image Overlay',
        'instructions' => 'Enter overlay copy in HTML or TWIG format'
    ],
    'size'       => [
        'name' => 'Image Size',
        'instructions' => 'Select a size for this masonry image'
    ],
    'overlay_background'       => [
        'name' => 'Image Overlay Background',
        'instructions' => 'Select an overlay background color'
    ],
    'tags' => [
        'name' => 'Tags',
        'instructions' => 'Select tags from the masonry block that apply to this image',
    ],
    'link_url'       => [
        'name' => 'URL',
        'instructions' => 'Enter a URL for the page OR video you would like linked to this image',
    ],
    'link_target'       => [
        'name' => 'Link Target',
        'instructions' => 'Select how you would like this link opened',
    ],
    'block' => [
        'name' => 'Block'
    ],
    'page' => [
        'name' => 'Page'
    ],
    'css'    => [ 'name' => 'CSS' ],
];

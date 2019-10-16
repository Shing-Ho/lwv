<?php

return [
    'module_segment'      => [
        'label'        => 'Module Segment',
        'instructions' => 'Define a custom segment URI for the the News module.'
    ],
    'enable_index'      => [
        'label'        => 'Enable the module\'s index route',
        'instructions' => 'When enabled an index of all post entries will be displayed when visiting the module segment URL.'
    ],
    'type_segment'    => [
        'label'        => 'Type Segment',
        'instructions' => 'Define a custom type segment URI for the type URLs.'
    ],
    'category_segment'    => [
        'label'        => 'Category Segment',
        'instructions' => 'Define a custom category segment URI for the category URLs.'
    ],
    'tag_segment'         => [
        'label'        => 'Tag Segment',
        'instructions' => 'Define a custom tag segment for the tag URLs.'
    ],
    'posts_per_page'      => [
        'label'        => 'Posts Per Page',
        'instructions' => 'Define how many posts to display per page on your website.'
    ],
    'sidebar'    => [
        'label'        => 'Enable Sidebar',
        'instructions' => 'Would you like the sidebar displayed next to post content?'
    ],
    'sidebar_categories'    => [
        'label'        => 'Sidebar Categories',
        'instructions' => 'Display category links on the sidebar? (Sidebar must be enabled)'
    ],
    'sidebar_featured'    => [
        'label'        => 'Sidebar Featured Posts',
        'instructions' => 'How many featured posts would you like displayed on the sidebar? (Set to 0 do disable)'
    ],
    'sidebar_archive'    => [
        'label'        => 'Sidebar Archive',
        'instructions' => 'Display archive links on the sidebar? (Sidebar must be enabled)'
    ],
    'sidebar_cache_duration'    => [
        'label'        => 'Sidebar Cache Expiration (Minutes)',
        'instructions' => 'To limit load on the database the sidebar is cached once rendered.  How often would you like this cache refreshed? (Set to 0 to disable cache)'
    ],
    'header'    => [
        'label'        => 'Header',
        'instructions' => 'Enter header content to display on news module pages',
        'warning' => 'HTML / TWIG Format'
    ],
    'intro'    => [
        'label'        => 'Intro',
        'instructions' => 'Enter intro content to display on news index page',
        'warning' => 'HTML / TWIG Format'
    ],
    'category_exclude'      => [
        'label'        => 'Categories To Exclude',
        'instructions' => 'Optionally enter a list of category IDs to exclude from the main News feed.',
        'warning' => 'Comma delimited'
    ],
];

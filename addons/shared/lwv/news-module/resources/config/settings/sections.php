<?php

return [
    [
        'tabs' => [
            'display'    => [
                'title'  => 'lwv.module.news::tab.display',
                'fields' => [
                    'posts_per_page',
                    'category_exclude',
                    'sidebar',
                    'sidebar_cache_duration',
                    'sidebar_categories',
                    'sidebar_featured',
                    'sidebar_archive',
                    'header',
                ]
            ],
            'permalinks' => [
                'title'  => 'lwv.module.news::tab.permalinks',
                'fields' => [
                    'module_segment',
                    'enable_index',
                    'type_segment',
                    'category_segment',
                    'tag_segment'
                ]
            ]
        ]
    ]
];

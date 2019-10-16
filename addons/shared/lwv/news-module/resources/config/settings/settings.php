<?php

return [
    'header' => [
        'type'   => 'anomaly.field_type.editor',
        'config' => [
            'mode'   => 'twig',
            'theme'  => 'monokai',
            'height' => 500
        ]
    ],
    'module_segment'      => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'news'
        ]
    ],
    'sidebar' => [
        'type'   => 'anomaly.field_type.boolean',
        'required' => false,
        'config' => [
            'default_value' => 0,
        ]
    ],
    'sidebar_cache_duration' => [
        'type'   => 'anomaly.field_type.integer',
        'required' => false,
        'config' => [
            'min'           => 0,
            'max'           => 60,
            'default_value' => 10,
        ]
    ],
    'sidebar_categories' => [
        'type'   => 'anomaly.field_type.boolean',
        'required' => false,
        'config' => [
            'default_value' => 0,
        ]
    ],
    'sidebar_featured' => [
        'type'   => 'anomaly.field_type.integer',
        'required' => false,
        'config' => [
            'min'           => 0,
            'max'           => 4,
            'default_value' => 0,
        ]
    ],
    'sidebar_archive' => [
        'type'   => 'anomaly.field_type.boolean',
        'required' => false,
        'config' => [
            'default_value' => 0,
        ]
    ],
    'enable_index' => [
        'type'   => 'anomaly.field_type.boolean',
        'required' => false,
        'config' => [
            'default_value' => 1,
        ]
    ],
    'type_segment'    => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'type'
        ]
    ],
    'category_segment'    => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'category'
        ]
    ],
    'tag_segment'         => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'tag'
        ]
    ],
    'posts_per_page'      => [
        'type'     => 'anomaly.field_type.integer',
        'required' => true,
        'config'   => [
            'default_value' => 15,
            'min'           => 1
        ]
    ],
    'category_exclude'         => [
        'type'     => 'anomaly.field_type.text',
        'required' => false,
    ],
];

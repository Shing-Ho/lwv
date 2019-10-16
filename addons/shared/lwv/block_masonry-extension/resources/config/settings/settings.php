<?php

return [
    'masonry_width' => [
        'type'   => 'anomaly.field_type.integer',
        'required' => true,
        'config' => [
            'min'           => 320,
            'max'           => 1300,
            'default_value' => 768,
        ]
    ],
    'masonry_height' => [
        'type'   => 'anomaly.field_type.integer',
        'required' => true,
        'config' => [
            'min'           => 320,
            'max'           => 1300,
            'default_value' => 768,
        ]
    ],
];

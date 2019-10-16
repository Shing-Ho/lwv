<?php

return [
    'block_cache_duration' => [
        'type'   => 'anomaly.field_type.integer',
        'required' => false,
        'config' => [
            'min'           => 1,
            'max'           => 1440,
            'default_value' => 720,
        ]
    ],
];

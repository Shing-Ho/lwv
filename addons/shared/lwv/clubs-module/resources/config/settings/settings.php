<?php

return [
    'module_root'      => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'clubs'
        ]
    ],
    'website_footer' => [
        'type'   => 'anomaly.field_type.editor',
        'config' => [
            'mode'   => 'twig',
            'theme'  => 'monokai',
            'height' => 300
        ]
    ],
];

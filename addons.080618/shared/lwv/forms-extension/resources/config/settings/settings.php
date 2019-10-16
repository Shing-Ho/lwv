<?php

return [
    'elapsed' => [
        'type'   => 'anomaly.field_type.integer',
        'config' => [
            'min'           => 0,
            'max'           => 10,
            'step'          => 1,
            'default_value' => 5
        ]
    ],
    'contact_json'      => [
        'type'   => "anomaly.field_type.editor",
        'required' => true,
        'config' => [
            'default_value' => '{"general":{"title":"General Inquiry","email":["info@lagunawoodsvillage.com","abc"]}}',
            'mode'          => 'json',
            'height'        => 400,
        ]
    ],
    'contact_email'      => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'info@lagunawoodsvillage.com',
        ]
    ],
    'contact_email_subject'      => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'New contact request',
        ]
    ],
    'contact_confirmation'      => [
        'type'     => 'anomaly.field_type.editor',
        'required' => true,
        'config'   => [
            'default_value' => '<p>Your request has been submitted successfully.</p>',
            'mode'          => 'html',
            'height'        => 200,
        ]
    ],
];

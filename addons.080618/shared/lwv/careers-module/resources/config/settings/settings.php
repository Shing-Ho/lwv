<?php

return [
    'careers_application_email_subject'      => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'New job applicant',
        ]
    ],
    'careers_admin_email'      => [
        'type'     => 'anomaly.field_type.text',
        'required' => true,
        'config'   => [
            'default_value' => 'jobs@vmsinc.org',
        ]
    ],
    'careers_types'      => [
        'type'     => 'anomaly.field_type.textarea',
        'required' => true,
        'config'   => [
            'default_value' => 'Residents'.PHP_EOL.'Non-Residents',
            'rows'          => 5,
        ]
    ],
    'careers_departments'      => [
        'type'     => 'anomaly.field_type.textarea',
        'required' => true,
        'config'   => [
            'rows'          => 5,
            'default_value' => 'General Services'.PHP_EOL.'Resident Services'.PHP_EOL.'Information Services'.PHP_EOL.'Financial Services'.PHP_EOL.'Security Services'.PHP_EOL.'Landscape Services'.PHP_EOL.'Recreation Services'.PHP_EOL.'Human Resources'.PHP_EOL.'Maintenance Services',
        ]
    ],
    'careers_search_prompt'      => [
        'type'     => 'anomaly.field_type.textarea',
        'required' => true,
        'config'   => [
            'default_value' => '<h3>Career Search</h3>'.PHP_EOL.'<p>Please use the search fields above to find career opportunities with Laguna Woods Village.</p>',
            'rows'          => 5,
        ]
    ],
    'careers_no_results'      => [
        'type'     => 'anomaly.field_type.textarea',
        'required' => true,
        'config'   => [
            'default_value' => '<h3>No Jobs Found</h3>'.PHP_EOL.'<p>No active job postings were found.</p>',
            'rows'          => 5,
        ]
    ],
    'careers_application_confirmation'      => [
        'type'     => 'anomaly.field_type.textarea',
        'required' => true,
        'config'   => [
            'default_value' => '<p>Your application has been submitted successfully. Please contact <a href="mailto::jobs@vmsinc.org">jobs@vmsinc.org</a> if you have any questions.</p>',
            'rows'          => 5,
        ]
    ],
];

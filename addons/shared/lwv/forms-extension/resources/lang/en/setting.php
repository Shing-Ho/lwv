<?php

return [
    'elapsed'      => [
        'label'        => 'Required Elapsed Time (Sec)',
        'instructions' => 'To help control spam from bots a minimum amount of time must have lapsed prior to submitting the form for form validation to succeed.',
        'warning' => 'Set to 0 to disable.'
    ],
    'contact_json'      => [
        'label'        => 'Contact Form JSON',
        'instructions' => 'Enter json to configure the contact form functionality',
        'warning' => 'Must be valid JSON'
    ],
    'contact_confirmation'      => [
        'label'        => 'Contact Confirmation',
        'instructions' => 'Enter HTML to display after a user has successfully submitted a contact request'
    ],
    'contact_email'      => [
        'label'        => 'Fallback Email Address',
        'instructions' => 'Where should new inquiries be emailed to if no configuration is supplied?  Multiple email addresses can be entered separated by a | character.',
    ],
    'contact_email_subject'      => [
        'label'        => 'Fallback Email Subject',
        'instructions' => 'Enter a default subject to use for contact emails if not configuration is supplied.'
    ],
];

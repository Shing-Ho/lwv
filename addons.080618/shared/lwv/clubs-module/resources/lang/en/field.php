<?php

return [
    'title' => [
        'name' => 'Title',
        'instructions' => 'Enter a unique title for this entry.',
    ],
    'intro' => [
        'name' => 'Introduction',
        'instructions' => 'Enter an introduction for this entry.',
    ],
    'description' => [
        'name' => 'Description',
        'instructions' => 'Enter an introduction for this entry.',
    ],
    'category' => [
        'name' => 'Category',
        'instructions' => 'Select a category for this club to aid users in searching.',
    ],
    'contact' => [
        'name' => 'Contact',
        'instructions' => 'Enter contact info if available.',
        'warning' => 'HTML Format'
    ],
    'hosting' => [
        'name' => 'Website',
        'instructions' => 'What type of website does this club have?',
    ],
    'url' => [
        'name' => 'Website URL',
        'instructions' => 'Enter a full URL for this external website.',
    ],
    'admins' => [
        'name' => 'Website Administrators',
        'instructions' => 'Add users who will administer this club website.',
    ],
    'slug' => [
        'name' => 'Slug',
        'instructions' => [
            'clubs'      => 'Enter a unique slug to use in club page URL for this club.',
            'news' => 'The slug is used in building the post\'s URL.',
        ],
    ],
    'logo' => [
        'name' => 'Club Logo',
        'instructions' => 'Optionally upload a logo to display on your club page.',
        'warning' => 'JPG Format Only >500px in width'
    ],
    'web_intro' => [
        'name' => 'Introduction',
        'instructions' => 'Optionally enter a short introduction for your club page.'
    ],
    'web_contact' => [
        'name' => 'Contact Information',
        'instructions' => 'Optionally provide contact information for your club.'
    ],
    'web_body' => [
        'name' => 'Body',
        'instructions' => 'Optionally enter body copy for your club page.'
    ],
    'enabled' => [
        'name' => 'Enabled',
        'instructions' => [
            'websites' => 'When enabled your club page will be visible to the public.',
            'news' => 'If disabled, you can still access a secure preview link in the control panel.'
        ],
        'warning' => [
            'websites' => 'You can preview your club page using the link provided on the admin page.',
            'news' => 'This post must be enabled before it can be viewed publicly.'
        ]
    ],
    'image_layout'       => [
        'name' => 'Header Style',
        'instructions' => 'Headers are automatically resized based on a percentage of the users screen height. Select a style for this header.',
    ],
    'image_position'       => [
        'name' => 'Header Position',
        'instructions' => 'How should the header background be positioned?',
    ],
    'image'       => [
        'name' => 'Image',
    ],
    'header' => [
        'name' => 'Header',
        'instructions' => 'Choose a header to display on your club page.',
    ],
    'document' => [
        'name' => 'Document',
        'instructions' => 'Upload a document file.',
    ],
    'image' => [
        'name' => 'Image',
        'instructions' => [
            'photos' => 'Upload a photo.',
            'news' => 'Optionally upload an image to display with this news post',
            'events' => 'Optionally upload an image to display with this news post',
        ],
        'warning' => [
            'photos' => ' Utilize highly compressed JPG images to keep page load times down',
            'news' => ' Utilize highly compressed JPG images to keep page load times down',
            'events' => ' Utilize highly compressed JPG images to keep page load times down',
        ],
    ],
    'teaser' => [
        'name' => 'Teaser',
        'instructions' => [
            'news' => 'Enter an optional teaser for this news article to display on the club news page',
        ],
    ],
    'body' => [
        'name' => 'Body',
        'instructions' => [
            'news' => 'Enter body copy to display with this news entry',
        ],
    ],
    'post_type' => [
        'name' => 'Type',
        'instructions' => [
            'news' => 'Select a type for this post',
        ],
    ],
    'publish_at'       => [
        'name'         => 'Publish Date/Time',
        'instructions' => 'Specify the publish date/time for this post.',
        'warning'      => 'If set to the future, this post will not be visible until then.',
    ],
    'publish_until'       => [
        'name'         => 'Publish Until Date/Time',
        'instructions' => 'Specify the date/time for this post to expire.',
        'warning'      => 'If none provided this post will remain permanent.  Must be later than the publish Date/Time.',
    ],
    'status'           => [
        'name'   => 'Status',
        'option' => [
            'live'      => 'Live',
            'draft'     => 'Draft',
            'scheduled' => 'Scheduled',
            'expired'   => 'Expired',
        ],
    ],
    'private' => [
        'name' => 'Visibility',
        'instructions' => 'Should this document be private?',
        'warning' => 'Private documents are visible only by those with specific permissions'
    ],
];

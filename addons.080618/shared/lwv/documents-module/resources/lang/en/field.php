<?php

return [
    'title' => [
        'name' => 'Title',
        'instructions' => 'Enter a title for this entry.',
    ],
    'slug' => [
        'name' => 'Slug',
    ],
    'enabled' => [
        'name' => 'Enabled',
        'instructions' => 'Should this folder be published?',
        'warning' => 'Disabling a folder will automatically unpublish all child folders and files'
    ],
    'searchable' => [
        'name' => 'Searchable',
        'instructions' => 'Should the contents of this folder be searchable?',
    ],
    'number' => [
        'name' => 'Number',
    ],
    'granicus' => [
        'name' => 'Granicus Video URL',
        'instructions' => 'Optionally enter a Granicus URL to allow users to view this meeting online'
    ],
    'resolutions' => [
        'name' => 'Resolutions',
    ],
    'folder_type' => [
        'name' => 'Folder Type',
        'instructions' => 'Select a content type you intend to store in this folder.',
    ],
    'private' => [
        'name' => 'Visibility',
        'instructions' => 'Should this document be private?',
        'warning' => 'Private documents are visible only by those with specific permissions'
    ],
    'description' => [
        'name' => 'Description',
        'instructions' => 'Enter an optional description for this entry.',
    ],
    'summary' => [
        'name' => 'Summary',
        'instructions' => 'Enter a summary for this resolution.',
    ],
    'passed' => [
        'name' => 'Status',
        'instructions' => 'Did this resolution pass or fail?',
    ],
    'document' => [
        'name' => 'Document',
        'instructions' => 'Upload a document file.',
    ],
];

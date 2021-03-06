<?php

return [
    'name'             => [
        'name'         => 'Name',
        'instructions' => [
            'types'      => 'Specify a short descriptive name for this post type.',
            'categories' => 'Specify a short descriptive name for this category.',
        ],
    ],
    'title'            => [
        'name'         => 'Title',
        'instructions' => 'Specify a short descriptive title for this post.',
    ],
    'slug'             => [
        'name'         => 'Slug',
        'instructions' => [
            'types'      => 'The slug is used in making the database table for posts of this type.',
            'categories' => 'The slug is used in building the category\'s URL.',
            'posts'      => 'The slug is used in building the post\'s URL.',
        ],
    ],
    'description'      => [
        'name'         => 'Description',
        'instructions' => [
            'types'      => 'Briefly describe the post type.',
            'categories' => 'Briefly describe the category.',
        ],
        'warning'      => 'This may or may not be displayed publicly depending on how your website was built.',
    ],
    'summary'          => [
        'name'         => 'Summary',
        'instructions' => 'Write a brief summary to introduce this post.',
    ],
    'category'         => [
        'name'         => 'Category',
        'instructions' => 'Choose which category this post belongs to.',
    ],
    'meta_title'       => [
        'name'         => 'Meta Title',
        'instructions' => 'Specify the SEO title.',
        'warning'      => 'The post title will be used by default.',
    ],
    'meta_description' => [
        'name'         => 'Meta Description',
        'instructions' => 'Specify the SEO description.',
    ],
    'meta_keywords'    => [
        'name'         => 'Meta Keywords',
        'instructions' => 'Specify the SEO keywords.',
    ],
    'theme_layout'     => [
        'name'         => 'Theme Layout',
        'instructions' => 'Specify the theme layout to wrap the <strong>post layout</strong> with.',
    ],
    'layout'           => [
        'name'         => 'Post Layout',
        'instructions' => 'The layout is used for displaying the post\'s content.',
    ],
    'tags'             => [
        'name'         => 'Tags',
        'instructions' => 'Specify any organizational tags to help group your post with others.',
    ],
    'enabled'          => [
        'name'         => 'Enabled',
        'label'        => 'Is this post enabled?',
        'instructions' => 'If disabled, you can still access a secure preview link in the control panel.',
        'warning'      => 'This post must be enabled before it can be viewed <strong>publicly</strong>.',
    ],
    'featured'         => [
        'name'         => 'Featured',
        'label'        => 'Is this a featured post?',
        'instructions' => 'Featured posts can be used to bring attention to specific posts.',
        'warning'      => 'This may or may not have an effect depending on how your website was built.',
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
    'intro'         => [
        'name'         => 'Introduction',
        'instructions' => 'Optionally enter copy to display above news content for this category.',
        'warning' => 'HTML / TWIG Format'
    ],
    'footer'         => [
        'name'         => 'Footer',
        'instructions' => 'Optionally enter copy to display below news content for this category.',
        'warning' => 'HTML / TWIG Format'
    ],
];

<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class LwvModuleDataCreateFaqsStream extends Migration
{
    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'faqs',
        'title_column' => 'question',
        'translatable' => false,
        'sortable' => true
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'question' => [
            'required' => true
        ],
        'faq_category' => [
            'required' => true
        ],
        'faq_layout' => [
            'required' => true
        ],
        'answer' => [
            'required' => false
        ],
        'link_url' => [
            'required' => false
        ],
        'link_target' => [
            'required' => true
        ],
    ];
}

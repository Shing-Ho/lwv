<?php namespace Lwv\NewsModule\Post\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Lwv\NewsModule\Post\Table\Filter\StatusFilterQuery;

/**
 * Class PostTableBuilder
 */
class PostTableBuilder extends TableBuilder
{

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'title',
            ]
        ],
        'category',
        'status' => [
            'filter'  => 'select',
            'query'   => StatusFilterQuery::class,
            'options' => [
                'live'      => 'lwv.module.news::field.status.option.live',
                'draft'     => 'lwv.module.news::field.status.option.draft',
                'scheduled' => 'lwv.module.news::field.status.option.scheduled',
                'expired'   => 'lwv.module.news::field.status.option.expired',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'title',
        'category',
        'status' => [
            'heading' => 'lwv.module.news::message.status',
            'value'   => 'entry.status_label',
        ],
    ];

    /**
     * The tree buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        'view' => [
            'target' => '_blank'
        ]
    ];

    /**
     * The table actions.
     *
     * @var array
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'publish_at' => 'DESC'
        ]
    ];

}

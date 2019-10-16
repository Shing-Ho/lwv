<?php namespace Lwv\CareersModule\Job\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Lwv\CareersModule\Job\Table\View\ActiveQuery;
use Lwv\CareersModule\Job\Table\View\ArchivedQuery;

class JobTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
        'active' => [
            'query' => ActiveQuery::class,
        ],
        'archived' => [
            'query' => ArchivedQuery::class,
        ],
    ];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'title',
            ]
        ],
        'type'
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'title',
        'type',
        'department',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'        => [
            'attributes' => [
                'data-toggle'  => 'confirm',
                'data-message' => 'Are you sure you want to permanently delete this job listing?'
            ]
        ],
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'order_by' => [
            'active' => 'desc',
            'id' => 'desc'
        ]
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}

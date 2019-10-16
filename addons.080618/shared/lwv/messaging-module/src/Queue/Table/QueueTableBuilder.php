<?php namespace Lwv\MessagingModule\Queue\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Lwv\MessagingModule\Queue\Table\View\ProcessedQuery;
use Lwv\MessagingModule\Queue\Table\View\UnprocessedQuery;

class QueueTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
        'unprocessed' => [
            'query' => UnprocessedQuery::class,
        ],
        'processed' => [
            'query' => ProcessedQuery::class,
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
                'type',
                'result',
            ]
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'type',
        'created_at'    => 'entry.created_at',
        'processed'       => 'entry.processed.label',
        'processed_at'  => 'entry.processed_at',
        'result' => 'entry.result'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'view' => [
            'data-toggle' => 'modal',
            'data-target' => '#modal',
        ]
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}

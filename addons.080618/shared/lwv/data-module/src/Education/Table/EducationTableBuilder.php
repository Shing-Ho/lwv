<?php namespace Lwv\DataModule\Education\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Lwv\DataModule\Education\Table\View\EmeritusQuery;
use Lwv\DataModule\Education\Table\View\ResidentQuery;

class EducationTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
        'resident' => [
            'query' => ResidentQuery::class,
        ],
        'emeritus' => [
            'query' => EmeritusQuery::class,
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
                'name',
            ],
        ],
        'clubhouse',
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'name',
        'entry.class_type.value',
        'entry.clubhouse.value',
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

<?php namespace Lwv\DataModule\Floorplan\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Lwv\DataModule\Floorplan\Table\Filter\SizeFilterQuery;

class FloorplanTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

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
        'mutual',
        'size' => [
            'filter'  => 'select',
            'query'   => SizeFilterQuery::class,
            'options' => [
                '<1000'   => '<1000 Sq Ft',
                '>1000'   => '1000+ Sq Ft',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'name',
        'entry.mutual.value',
        'size',
        'bedrooms',
        'baths',
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

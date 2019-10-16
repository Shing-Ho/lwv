<?php namespace Lwv\DataModule\Faq\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class FaqTableBuilder extends TableBuilder
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
                'question',
            ],
        ],
        'faq_category'
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'question',
        'entry.faq_category.value',
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

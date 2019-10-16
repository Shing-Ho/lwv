<?php namespace Lwv\CareersModule\Applicant\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class ApplicantTableBuilder extends TableBuilder
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
                'email',
            ]
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'application_date'          => [
            'sort_column' => 'created_at',
            'value'       => 'entry.created_at'
        ],
        'name',
        'email',
        [
            'heading' => 'Job',
            'column' => 'Lwv\CareersModule\Applicant\Table\Column\JobColumn',
            'sort_column' => 'job',
        ],
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
        'delete'        => [
            'attributes' => [
                'data-toggle'  => 'confirm',
                'data-message' => 'Are you sure you want to permanently delete this job applicant?'
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
            'created_at' => 'desc'
        ]
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}

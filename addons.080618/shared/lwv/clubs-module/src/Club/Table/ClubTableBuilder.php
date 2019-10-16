<?php namespace Lwv\ClubsModule\Club\Table;

use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class ClubTableBuilder extends TableBuilder
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
                'title',
            ],
        ],
        'category',
        'hosting'
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'title',
        'entry.category.value',
        'entry.hosting.value',
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
    protected $options = [
        'websites' => false
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * Fired just before starting the query.
     *
     * @param Builder $query
     */
    public function onQuerying(ClubRepositoryInterface $clubs, Builder $query)
    {
        if ($this->options['websites']) {
            $query->where('hosting', 'internal');
        }

        // Limit entries to only my clubs if not an admin
        $id = $clubs->myClubs()->keyBy('id')->keys()->toArray();
        $query->whereIn('id', $id);
    }

    /**
     * Fired just before building.
     *
     * @param Builder $query
     */
    public function onReady()
    {
        if ($this->options['websites']) {
            // Club Website Table
            $this->setActions([]);

            $this->setFilters(
                array_filter(
                    $this->getFilters(),
                    function($arr) {
                        return $arr !== 'category';
                    }
                )
            );

            $this->setButtons([
                'manage'   => [
                    'href' => 'admin/clubs/websites/manage/{entry.id}',
                    'type' => 'info',
                    'icon' => 'fa fa-gears'
                ],
            ]);

            $this->setColumns(
                array_filter(
                    $this->getColumns(),
                    function($arr) {
                        return $arr !== 'entry.category.value';
                    }
                )
            );
        }
    }
}

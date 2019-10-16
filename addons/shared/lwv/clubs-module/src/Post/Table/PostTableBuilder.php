<?php namespace Lwv\ClubsModule\Post\Table;

use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Lwv\ClubsModule\Post\Table\Filter\StatusFilterQuery;
use Lwv\ClubsModule\Post\Table\View\NewsQuery;
use Lwv\ClubsModule\Post\Table\View\EventsQuery;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class PostTableBuilder extends TableBuilder
{
    /**
     * The club.
     *
     * @var null|ClubInterface
     */
    protected $club = null;

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [
        'news' => [
            'query' => NewsQuery::class,
        ],
        'events' => [
            'query' => EventsQuery::class,
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
        'status' => [
            'filter'  => 'select',
            'query'   => StatusFilterQuery::class,
            'options' => [
                'live'      => 'lwv.module.clubs::field.status.option.live',
                'draft'     => 'lwv.module.clubs::field.status.option.draft',
                'scheduled' => 'lwv.module.clubs::field.status.option.scheduled',
                'expired'   => 'lwv.module.clubs::field.status.option.expired',
            ],
        ],
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'image' => [
            'value' => 'entry.image_preview',
        ],
        'title',
        'publish_at' => [
            'value' => 'entry.publish_at.format(\'d F, Y g:i A\')'
        ],
        'status' => [
            'heading' => 'lwv.module.clubs::message.status',
            'value'   => 'entry.status_label',
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit' => [
            'href' => 'admin/clubs/websites/posts/{request.route.parameters.club}/edit/{entry.id}?view={request.input.view}'
        ],
        'view' => [
            'target' => '_blank',
            'href' => 'admin/clubs/websites/posts/view/{entry.id}'
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
    protected $options = [
        'order_by' => [
            'publish_at' => 'DESC'
        ]
    ];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * Get the club.
     *
     * @return null|ClubInterface
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set the club.
     *
     * @param  ClubInterface $club
     * @return $this
     */
    public function setClub(ClubInterface $club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Fired just before starting the query.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        // Limit entries to only posts from the specified club
        $query->where('club_id', $this->getClub()->id);
    }
}

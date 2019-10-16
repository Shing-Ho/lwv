<?php namespace Lwv\ClubsModule\Document\Table;

use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class DocumentTableBuilder extends TableBuilder
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
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'title',
        'entry.private.label'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = DocumentTableButtons::class;

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
        // Limit entries to only documents from the specified club
        $query->where('club_id', $this->getClub()->id);
    }
}

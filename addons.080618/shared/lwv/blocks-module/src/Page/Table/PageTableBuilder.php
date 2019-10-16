<?php namespace Lwv\BlocksModule\Page\Table;

use Anomaly\PagesModule\Page\PageModel;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Route;
use DB;

/**
 * Class PageTableBuilder
 */
class PageTableBuilder extends TableBuilder
{

    /**
     * Pages
     *
     * @var array
     */
    protected $pages = [];

    /**
     * The ajax flag.
     *
     * @var bool
     */
    protected $ajax = true;

    /**
     * The table model.
     *
     * @var string
     */
    protected $model = PageModel::class;

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'select' => [
            'data-page' => 'entry.id',
            'data-block-type' => 'entry.block_type',
            'data-block-id' => 'entry.block_id',
        ]
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [
        'title' => 'Which page would you like to copy to?',
        'sortable' => false,
    ];

    /**
     * Fired when query starts building.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query, Route $route)
    {
        // inject values into query
        $query->select(['pages_pages.id',DB::raw('\''.$route->getParameter("type").'\' as block_type'),DB::raw('\''.$route->getParameter("id").'\' as block_id')]);
    }

    /**
     * Get the pages.
     *
     * @return array
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set the pages.
     *
     * @param array $pages
     * @return $this
     */
    public function setPages(array $pages = [])
    {
        $this->pages = $pages;

        return $this;
    }

}

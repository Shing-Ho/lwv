<?php namespace Lwv\SearchModule\Sitemap\Tree;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;
use Anomaly\PagesModule\Page\PageModel;

/**
 * Class SitemapTreeBuilder
 */
class SitemapTreeBuilder extends TreeBuilder
{
    /**
     * The tree model.
     *
     * @var null|string
     */
    protected $model = PageModel::class;

    /**
     * The tree options.
     *
     * @var array
     */
    protected $options = [
        'tree_view' => 'lwv.module.search::sitemap/tree',
        'permission' => 'lwv.module.search::sitemap.read'
    ];

    /**
     * The item buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The item segments.
     *
     * @var array|string
     */
    protected $segments = [
        'entry.title'
    ];
}

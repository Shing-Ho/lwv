<?php namespace Lwv\BlocksModule\Http\Controller\Admin;

use Lwv\BlocksModule\Page\Table\PageTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

/**
 * Class PagesController
 */
class PagesController extends AdminController
{

    /**
     * Return an index of existing pages.
     *
     * @param PageTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PageTableBuilder $table, Route $route)
    {
        return $table->render();
    }

}

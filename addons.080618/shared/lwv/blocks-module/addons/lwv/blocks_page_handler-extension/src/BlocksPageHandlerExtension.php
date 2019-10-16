<?php namespace Lwv\BlocksPageHandlerExtension;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Handler\PageHandlerExtension;
use Lwv\BlocksPageHandlerExtension\Command\MakePage;
use Lwv\BlocksModule\Block\BlockService;

/**
 * Class BlocksPageHandlerExtension
 *
 */
class BlocksPageHandlerExtension extends PageHandlerExtension
{

    /**
     * This extension provides the default
     * page handler for the Pages module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.pages::handler.blocks';
    /**
     * Make the page's response.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        // Build breadcrumb so blocks can access
        $breadcrumb = app('Anomaly\PagesModule\Page\PageBreadcrumb');
        $breadcrumb->make($page);

        // Build blocks
        if ($page->type->slug == 'block') {
            $blockService = new BlockService();
            $blockService->build($page);
            $blockService->hydrate();
            $blockService->render();
        }

        // Build page
        $this->dispatch(new MakePage($page));
    }
}

<?php namespace Lwv\BlocksModule\Block\Command;

use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlocksModule\Block\BlockModel;
use Lwv\BlocksModule\Block\BlockService;
use Cache;
use App;

/**
 * Class PurgeBlockCache
 */
class PurgeBlockCache
{

    /**
     * The page instance.
     *
     * @var PageModel
     */
    protected $page;

    /**
     * Create a new PurgeBlockCache instance.
     *
     * @param PageModel $page
     */
    public function __construct(PageModel $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     *
     * @param BlockService $blockService
     */
    public function handle(BlockService $blockService)
    {
        // Init the block service
        $blockService->build($this->page);
        $locales = config('streams::locales.enabled');

        // Purge cache for all blocks on this page
        $cacheKeys = [$blockService->getCacheKey()];

        foreach ($blockService->getBlocks() as $block) {
            foreach ($locales as $locale) {
                $cacheKeys[] = $block['type']['slug'].'_'.$block['id'].'-'.$locale.'-'.strtotime($this->page->updated_at ?: $this->page->created_at);
            }
        }

        foreach ($cacheKeys as $cacheKey) {
            Cache::forget($cacheKey);
        }

        // Reset timestamps on page
        $model = new BlockModel();
        $model->touchPage($this->page->id);
    }
}

<?php namespace Lwv\BlocksModule\Block\Command;

use Anomaly\Streams\Platform\View\ViewTemplate;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Lwv\BlocksModule\Block\BlockService;
use App;
use Cache;
use DB;

/**
 * Class BuildBlocks
 */
class BuildBlocks
{
    /**
     * Blocks service
     *
     * @var BlockService
     */
    protected $blockService;

    /**
     * Create a new BuildBlocks instance.
     */
    public function __construct(BlockService $blockService)
    {
        $this->blockService = $blockService;
    }

    /**
     * Handle the command.
     */
    public function handle(
        ViewTemplate $viewTemplate,
        SettingRepositoryInterface $settings
    ) {
        // Retrieve blocks from cache or database
        $sort = [];
        $blocks = [];

        if ($this->blockService->allowCache() && Cache::has($this->blockService->getCacheKey())) {
            $blocks = Cache::get($this->blockService->getCacheKey());
            $viewTemplate->put('cacheHits', array_merge($viewTemplate->get('cacheHits',[]),[$this->blockService->getCacheKey() => 'CACHE']));
        } else {
            // Loop through installed block types and retrieve page blocks
            foreach ($this->blockService->getTypes() as $type) {
                $results = DB::table($type->table)->where('page',$this->blockService->getPage()->id)->get();

                foreach ($results as $result) {
                    $result->type = $type->toArray();
                    $sort[$result->weight][] = $result;
                }
            }
            // Sort results by weight
            ksort($sort);

            foreach ($sort as $results) {
                foreach ($results as $result) {
                    $blocks[] = (array) $result;
                }
            }

            // Cache block data
            if (!App::runningInConsole()) {
                Cache::add($this->blockService->getCacheKey(), $blocks, $settings->value('lwv.module.blocks::block_cache', 15));
            }

            $viewTemplate->put('cacheHits', array_merge($viewTemplate->get('cacheHits',[]),[$this->blockService->getCacheKey() => 'DB']));
        }

        $this->blockService->setBlocks($blocks);
    }
}

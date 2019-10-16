<?php namespace Lwv\BlocksModule\Block\Command;

use Anomaly\Streams\Platform\Asset\Asset;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Lwv\BlocksModule\Block\BlockService;
use Lwv\BlocksModule\Template\TemplateModel;
use Cache;
use App;

/**
 * Class RenderBlocks
 */
class RenderBlocks
{

    /**
     * Blocks service
     *
     * @var BlockService
     */
    protected $blockService;

    /**
     * Create a new RenderBlocks instance.
     */
    public function __construct(BlockService $blockService)
    {
        $this->blockService = $blockService;
    }

    public function cacheKey($block) {
        return $block['type']['slug'].'_'.$block['id'].'-'.App::getLocale().'-'.strtotime($this->blockService->getPage()->updated_at ?: $this->blockService->getPage()->created_at);
    }

    /**
     * Handle the command.
     */
    public function handle(
        Asset $assets,
        ViewTemplate $viewTemplate,
        TemplateModel $templates,
        SettingRepositoryInterface $settings
    ) {
        $rendered = [];

        // Loop through blocks and render each
        foreach ($this->blockService->getBlocks() as $key => $pageblock) {
            list($block, $type) = [$pageblock['model'], $pageblock['type']];

            if ($this->blockService->allowCache() && isset($pageblock['cache_enabled']) && $pageblock['cache_enabled'] && Cache::has($this->cacheKey($pageblock))) {
                $rendered[$key] = Cache::get($this->cacheKey($pageblock));
                $viewTemplate->put('cacheHits', array_merge($viewTemplate->get('cacheHits',array()),[$this->cacheKey($pageblock) => 'CACHE']));
            } else {
                if ($template = $templates->where('block_type',$pageblock['type']['slug'])->first()) {
                    // Use template stored for this block type
                    $layout = $template->getFieldType('template');
                    $rendered[$key] = view($layout->getViewPath(), compact('block','type'))->render();
                } else {
                    // Use default template bundled with module
                    $rendered[$key] = view('lwv.extension.'.$type['slug'].'::block', compact('block','type'))->render();
                }

                // Cache block if requested for 12 hrs
                if ($this->blockService->allowCache() && isset($pageblock['cache_enabled']) && $pageblock['cache_enabled']) {
                    Cache::add($this->cacheKey($pageblock), $rendered[$key], $settings->value('lwv.module.blocks::block_cache', 15));
                }

                $viewTemplate->put('cacheHits', array_merge($viewTemplate->get('cacheHits',[]),[$this->cacheKey($pageblock) => 'DB']));
            }

            // Add block level CSS
            if ($css = $block->getFieldTypePresenter('css')) {
                $assets->add('styles.css', $css->path());
            }
        }

        $viewTemplate->put('blocks', implode("\n",$rendered));
    }
}

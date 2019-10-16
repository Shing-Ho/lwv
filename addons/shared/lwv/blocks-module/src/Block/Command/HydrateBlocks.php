<?php namespace Lwv\BlocksModule\Block\Command;

use Lwv\BlocksModule\Block\BlockService;


/**
 * Class HydrateBlocks
 */
class HydrateBlocks
{

    /**
     * Blocks service
     *
     * @var BlockService
     */
    protected $blockService;

    /**
     * Create a new HydrateBlocks instance.
     */
    public function __construct(BlockService $blockService)
    {
        $this->blockService = $blockService;
    }

    /**
     * Handle the command.
     */
    public function handle() {
        // Loop through blocks and hydrate each
        foreach ($this->blockService->getBlocks() as $key => $block) {
            $model = new $block['type']['model'];
            $this->blockService->setBlockValues($key,['model' => $model->find($block['id'])]);
        }
    }
}

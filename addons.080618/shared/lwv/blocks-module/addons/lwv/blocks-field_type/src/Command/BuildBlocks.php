<?php namespace Lwv\BlocksFieldType\Command;

use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlocksFieldType\BlocksFieldType;
use Lwv\BlocksModule\Block\BlockService;

class BuildBlocks
{
    protected $fieldType;

    function __construct(BlocksFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     */
    public function handle(BlockService $blockService, PageModel $pages)
    {
        // Get page
        if ($page = $pages->where('entry_type',get_class($this->fieldType->getEntry()))->where('entry_id',$this->fieldType->getEntry()->getId())->first()) {
            $this->fieldType->setPage($page);

            // Initialize block service
            $blockService->build($page);

            // Set field type
            $this->fieldType->setBlocks($blockService->getBlocks());

            // Set message
            if (!$blockService->getBlocks()) {
                $this->fieldType->setMessage(
                    [
                        'type' => 'info-circle',
                        'message' => 'No Blocks Found'
                    ]
                );
            }
        } else {
            $this->fieldType->setMessage(
                [
                    'type' => 'warning',
                    'message' => 'The Blocks UI will activate after the page is saved'
                ]
            );
        }
    }
}

<?php namespace Lwv\BlockImagesFieldType\Command;

use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlockImagesFieldType\BlockImagesFieldType;
use Lwv\BlocksModule\Block\BlockService;

class BuildImages
{
    protected $fieldType;

    function __construct(BlockImagesFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Handle the command.
     */
    public function handle(BlockService $blockService, PageModel $pages)
    {
        // Get block
        $block = $this->fieldType->getEntry();

        if ($block->getId()) {
            // Get page
            $page = $pages->find($block->page);

            // Init field type
            $this->fieldType->setBlock($block);
            $this->fieldType->setExtension($blockService->getTypeBySlug($block->getStreamNamespace()));
            $this->fieldType->setPage($page);

            // Get images
            $this->fieldType->setImages($block->images()->get());

            if (!$this->fieldType->getImages()->count()) {
                // Set message
                $this->fieldType->setMessage(
                    [
                        'type' => 'info-circle',
                        'message' => 'No Images Found'
                    ]
                );
            }

        } else {
            $this->fieldType->setMessage(
                [
                    'type' => 'warning',
                    'message' => 'The Images UI will activate after the block is saved'
                ]
            );
        }
    }
}

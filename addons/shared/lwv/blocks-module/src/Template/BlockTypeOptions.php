<?php namespace Lwv\BlocksModule\Template;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\SelectFieldType\SelectFieldType;
use Lwv\BlocksModule\Block\BlockService;

class BlockTypeOptions
{
    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param  SelectFieldType $fieldType
     * @return array
     */
    public function handle(SelectFieldType $fieldType, BlockService $blockService)
    {
        $options = [];

        foreach ($blockService->getTypes() as $type) {
            $options[$type->slug] = $type->slug;
        }

        $fieldType->setOptions($options);
    }
}

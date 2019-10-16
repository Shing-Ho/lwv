<?php namespace Lwv\BlockMasonryExtension\Block;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\CheckboxesFieldType\CheckboxesFieldType;
use Illuminate\Http\Request;
use Lwv\BlockMasonryExtension\Block\BlockModel;

class BlockFilterOptions
{
    use DispatchesJobs;

    /**
     * Handle the select options.
     *
     * @param CheckboxesFieldType $fieldType
     */
    public function handle(CheckboxesFieldType $fieldType, Request $request, BlockModel $blockModel)
    {
        $options = [];
        $entry = $fieldType->getEntry();
        $id = ($request->route('bid')) ? $request->route('bid') : $entry->block;
        $block = $blockModel->find($id);

        if ($block) {
            foreach ($block->filters() as $filter) {
                $options[$filter['key']] = $filter['value'];
            }
        }

        $fieldType->setOptions($options);
    }
}

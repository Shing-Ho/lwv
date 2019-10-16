<?php namespace Lwv\BlockMasonryExtension\Block;

use Lwv\BlockMasonryExtension\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Model\BlockMasonry\BlockMasonryBlocksEntryModel;

class BlockModel extends BlockMasonryBlocksEntryModel implements BlockInterface
{
    /**
     * Get the images for this block
     */
    public function images()
    {
        return $this->hasMany('Lwv\BlockMasonryExtension\Image\ImageModel','block')->orderBy('weight');
    }

    /**
     * Build the block filters
     */
    public function filters()
    {
        $filters = [];

        $lines = array_filter(
            explode("\r\n",trim($this->filters)),
            function ($line) {
                return trim($line);
            }
        );

        foreach ($lines as $line) {
            list($key, $value) = explode('|', trim($line));
            $filters[] = ['key' => $key, 'value' => $value];
        }

        return $filters;
    }
}

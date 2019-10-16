<?php namespace Lwv\BlockHeaderExtension\Block;

use Lwv\BlockHeaderExtension\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Model\BlockHeader\BlockHeaderBlocksEntryModel;

class BlockModel extends BlockHeaderBlocksEntryModel implements BlockInterface
{
    /**
     * Get the images for this block
     */
    public function images()
    {
        return $this->hasMany('Lwv\BlockHeaderExtension\Image\ImageModel','block')->orderBy('weight');
    }
}

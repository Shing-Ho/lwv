<?php namespace Lwv\BlockSliderExtension\Block;

use Lwv\BlockSliderExtension\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Model\BlockSlider\BlockSliderBlocksEntryModel;

class BlockModel extends BlockSliderBlocksEntryModel implements BlockInterface
{
    /**
     * Get the images for this block
     */
    public function images()
    {
        return $this->hasMany('Lwv\BlockSliderExtension\Image\ImageModel','block')->orderBy('weight');
    }
}

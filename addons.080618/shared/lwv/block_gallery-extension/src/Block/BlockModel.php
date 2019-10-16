<?php namespace Lwv\BlockGalleryExtension\Block;

use Lwv\BlockGalleryExtension\Block\Contract\BlockInterface;
use Anomaly\Streams\Platform\Model\BlockGallery\BlockGalleryBlocksEntryModel;

class BlockModel extends BlockGalleryBlocksEntryModel implements BlockInterface
{
    /**
     * Get the images for this block
     */
    public function images()
    {
        return $this->hasMany('Lwv\BlockGalleryExtension\Image\ImageModel','block')->orderBy('weight');
    }
}

<?php namespace Lwv\BlockSliderExtension\Image;

use Lwv\BlockSliderExtension\Image\Contract\ImageInterface;
use Anomaly\Streams\Platform\Model\BlockSlider\BlockSliderImagesEntryModel;

class ImageModel extends BlockSliderImagesEntryModel implements ImageInterface
{
    public function icon()
    {
        $icons = [
            'photo' => 'fa-file-image-o',
            'lightbox' => 'fa-photo',
            'video' => 'fa-video-camera',
            'linked' => 'fa-bolt',
            'text' => 'fa-file-image-o',
        ];

        return isset($icons[$this->image_layout]) ? $icons[$this->image_layout] : '';
    }
}

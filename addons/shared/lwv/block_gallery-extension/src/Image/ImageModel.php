<?php namespace Lwv\BlockGalleryExtension\Image;

use Lwv\BlockGalleryExtension\Image\Contract\ImageInterface;
use Anomaly\Streams\Platform\Model\BlockGallery\BlockGalleryImagesEntryModel;

class ImageModel extends BlockGalleryImagesEntryModel implements ImageInterface
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

    public function overlay()
    {
        $template = app('Anomaly\Streams\Platform\Support\Template');
        return $template->render($this->overlay);
    }

    public function body()
    {
        $template = app('Anomaly\Streams\Platform\Support\Template');
        return $template->render($this->body);
    }
}

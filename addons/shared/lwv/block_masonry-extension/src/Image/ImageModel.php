<?php namespace Lwv\BlockMasonryExtension\Image;

use Lwv\BlockMasonryExtension\Image\Contract\ImageInterface;
use Anomaly\Streams\Platform\Model\BlockMasonry\BlockMasonryImagesEntryModel;

class ImageModel extends BlockMasonryImagesEntryModel implements ImageInterface
{
    public function icon()
    {
        $icons = [
            'photo' => 'fa-file-image-o',
            'lightbox' => 'fa-photo',
            'video' => 'fa-video-camera',
            'linked' => 'fa-bolt',
            'content' => 'fa-list-alt',
        ];

        return isset($icons[$this->image_layout]) ? $icons[$this->image_layout] : '';
    }

    public function tags()
    {
        return implode(' ',$this->tags);
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

<?php namespace Lwv\BlockHeaderExtension\Image;

use Lwv\BlockHeaderExtension\Image\Contract\ImageInterface;
use Anomaly\Streams\Platform\Model\BlockHeader\BlockHeaderImagesEntryModel;

class ImageModel extends BlockHeaderImagesEntryModel implements ImageInterface
{
    public function icon()
    {
        $icons = [
            'full' => 'fa-television',
            '60' => 'fa-television',
            '40' => 'fa-television',
        ];

        return isset($icons[$this->image_layout]) ? $icons[$this->image_layout] : '';
    }

    public function overlay()
    {
        $template = app('Anomaly\Streams\Platform\Support\Template');
        return $template->render($this->overlay);
    }
}

<?php namespace Lwv\BlockGalleryExtension\Image;

use Lwv\BlockGalleryExtension\Image\Contract\ImageRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ImageRepository extends EntryRepository implements ImageRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ImageModel
     */
    protected $model;

    /**
     * Create a new ImageRepository instance.
     *
     * @param ImageModel $model
     */
    public function __construct(ImageModel $model)
    {
        $this->model = $model;
    }
}

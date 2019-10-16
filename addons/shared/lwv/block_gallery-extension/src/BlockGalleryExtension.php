<?php namespace Lwv\BlockGalleryExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class BlockGalleryExtension extends Extension
{

    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-th-large';

    /**
     * The block type slug
     *
     * @var string
     */
    protected $slug = 'block_gallery';

    /**
     * The block type model
     *
     * @var string
     */
    protected $model = 'Lwv\BlockGalleryExtension\Block\BlockModel';

    /**
     * The block Type Table
     *
     * @var string
     */
    protected $table = 'block_gallery_blocks';

    /**
     * This extension provides
     */
    protected $provides = 'lwv.module.blocks::block.gallery';

    /**
     * Related streams
     */
    protected $related = ['Lwv\BlockGalleryExtension\Image\ImageModel'];

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id'        => $this->getNamespace(),
            'name'      => $this->getName(),
            'title'      => $this->getTitle(),
            'namespace' => $this->getNamespace(),
            'type'      => $this->getType(),
            'provides' => $this->getProvides(),
            'icon' => $this->icon,
            'slug' => $this->slug,
            'model' => $this->model,
            'table' => $this->table,
            'related' => $this->related,
        ];
    }

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('block_gallery_images')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Block Gallery Images',
                            'description' => 'Blocks Module',
                        ],
                        'slug'          => 'block_gallery_images',
                        'disk'          => $disk,
                        'allowed_types' => [
                            'jpeg',
                            'jpg',
                            'png'
                        ],
                    ]
                );
            }
        }
    }

}

<?php namespace Lwv\BlockImageExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

class BlockImageExtension extends Extension
{
    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-photo';

    /**
     * The block type slug
     *
     * @var string
     */
    protected $slug = 'block_image';

    /**
     * The block type model
     *
     * @var string
     */
    protected $model = 'Lwv\BlockImageExtension\Block\BlockModel';

    /**
     * The block Type Table
     *
     * @var string
     */
    protected $table = 'block_image_blocks';

    /**
     * This extension provides
     */
    protected $provides = 'lwv.module.blocks::block.image';

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
        ];
    }

    /**
     * Fired just before module is installed.
     */
    public function onInstalling(DiskRepositoryInterface $disks, FolderRepositoryInterface $folders)
    {
        if ($disk = $disks->findBySlug('local')) {
            if (!$folder = $folders->findBySlug('block_images')) {
                $folders->create(
                    [
                        'en'            => [
                            'name'        => 'Block Images',
                            'description' => 'Blocks Module',
                        ],
                        'slug'          => 'block_images',
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

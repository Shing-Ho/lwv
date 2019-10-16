<?php namespace Lwv\BlockCustomExtension;

use Anomaly\Streams\Platform\Addon\Extension\Extension;

class BlockCustomExtension extends Extension
{
    /**
     * The navigation icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-code';

    /**
     * The block type slug
     *
     * @var string
     */
    protected $slug = 'block_custom';

    /**
     * The block type model
     *
     * @var string
     */
    protected $model = 'Lwv\BlockCustomExtension\Block\BlockModel';

    /**
     * The block Type Table
     *
     * @var string
     */
    protected $table = 'block_custom_blocks';

    /**
     * This extension provides
     */
    protected $provides = 'lwv.module.blocks::block.custom';

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
}

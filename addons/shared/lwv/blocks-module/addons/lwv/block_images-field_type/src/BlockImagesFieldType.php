<?php namespace Lwv\BlockImagesFieldType;

use Illuminate\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlockImagesFieldType\Command\BuildImages;


class BlockImagesFieldType extends FieldType
{
    use DispatchesJobs;

    /**
     * No database column.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'lwv.field_type.block_images::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The images
     *
     * @var null|array
     */
    protected $images = null;

    /**
     * The message
     *
     * @var null|array
     */
    protected $message = null;

    /**
     * The page
     *
     * @var null|PageModel
     */
    protected $page = null;

    /**
     * The block
     *
     * @var null|BlockModel
     */
    protected $block = null;

    /**
     * The block extension
     *
     * @var null|Extension
     */
    protected $extension = null;

    /**
     * Create a new BlockImagesFieldType instance.
     */
    public function __construct() {
    }

    /**
     * Get the images
     */
    public function getImages()
    {
        if ($this->images === null) {
            $this->dispatch(new BuildImages($this));
        }

        return $this->images;
    }


    /**
     * Set the images
     *
     * @param $images
     * @return $this
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Set the block
     *
     * @param $block
     */
    public function setBlock($block)
    {
        $this->block = $block;
    }

    /**
     * Get the block
     *
     * @return BlockModel|null
     */
    public function getBlock()
    {
        if ($this->block === null) {
            $this->dispatch(new BuildImages($this));
        }

        return $this->block;
    }

    /**
     * Set the page
     *
     * @param PageModel $page
     */
    public function setPage(PageModel $page)
    {
        $this->page = $page;
    }

    /**
     * Get the page
     *
     * @return PageModel|null
     */
    public function getPage()
    {
        if ($this->page === null) {
            $this->dispatch(new BuildBlocks($this));
        }

        return $this->page;
    }

    /**
     * Set extension
     *
     * @param Extension $extension
     */
    public function setExtension(Extension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * Get extension
     *
     * @return null|Extension
     */
    public function getExtension()
    {
        if ($this->extension === null) {
            $this->dispatch(new BuildImages($this));
        }

        return $this->extension;
    }

    /**
     * Get the message
     *
     * @return null|array
     */
    public function getMessage()
    {
        if ($this->message === null) {
            $this->dispatch(new BuildImages($this));
        }

        return $this->message;
    }

    /**
     * Set the message
     *
     * @param null|array $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        return;
    }
}

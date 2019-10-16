<?php namespace Lwv\BlocksFieldType;

use Illuminate\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Lwv\BlocksFieldType\Command\BuildBlocks;

class BlocksFieldType extends FieldType
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
    protected $inputView = 'lwv.field_type.blocks::input';

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The blocks
     *
     * @var null|array
     */
    protected $blocks = null;

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
     * Create a new BlocksFieldType instance.
     */
    public function __construct() {
    }

    /**
     * Get the list of blocks.
     *
     * @return array
     */
    public function getBlocks()
    {
        if ($this->blocks === null) {
            $this->dispatch(new BuildBlocks($this));
        }

        return $this->blocks;
    }

    /**
     * Set the blocks.
     *
     * @param array $blocks
     * @return $this
     */
    public function setBlocks(array $blocks)
    {
        $this->blocks = $blocks;

        return $this;
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
     * Get the message
     *
     * @return null|array
     */
    public function getMessage()
    {
        if ($this->message === null) {
            $this->dispatch(new BuildBlocks($this));
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

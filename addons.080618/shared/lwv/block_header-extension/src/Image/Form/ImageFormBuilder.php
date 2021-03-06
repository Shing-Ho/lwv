<?php namespace Lwv\BlockHeaderExtension\Image\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Lwv\BlockHeaderExtension\Block\BlockModel;

class ImageFormBuilder extends FormBuilder
{
    /**
     * The block
     *
     * @var BlockModel $block
     */
    protected $block;

    /**
     * The block extension
     */
    protected $extension;

    /**
     * Set extension
     */
    public function setExtension($extension)
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
     * Set block
     *
     * @param BlockModel $block
     */
    public function setBlock(BlockModel $block) {
        $this->block = $block;
        $this->fields['block']['value'] = $block->id;
    }

    /**
     * Get block
     *
     * @return BlockModel
     */
    public function getBlock() {
        return $this->block;
    }

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        'image',
        'image_layout',
        'image_position',
        'overlay',
        'block' => [
            'hidden' => true
        ],
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [
        'save'
    ];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'cancel'
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [
        'scripts.js' => [
            'lwv.extension.block_header::js/form.js',
        ],
    ];

}

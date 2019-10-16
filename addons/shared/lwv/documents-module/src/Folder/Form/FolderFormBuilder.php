<?php namespace Lwv\DocumentsModule\Folder\Form;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class FolderFormBuilder extends FormBuilder
{
    /**
     * The parent page.
     *
     * @var null|FolderInterface
     */
    protected $parent = null;

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
        'parent',
        'path'
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [
        'save_exit'
    ];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

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
    protected $assets = [];

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry  = $this->getFormEntry();
        $parent = $this->getParent();

        if ($parent) {
            $entry->parent_id = $parent->getId();
        }
    }

    /**
     * Get the parent folder.
     *
     * @return null|FolderInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent folder.
     *
     * @param  FolderInterface $parent
     * @return $this
     */
    public function setParent(FolderInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }
}

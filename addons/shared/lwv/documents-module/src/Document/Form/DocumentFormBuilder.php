<?php namespace Lwv\DocumentsModule\Document\Form;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class DocumentFormBuilder extends FormBuilder
{
    /**
     * The folder.
     *
     * @var null|FolderInterface
     */
    protected $folder = null;
    
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
        'folder',
        'granicus'
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
     * Get the folder.
     *
     * @return null|FolderInterface
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the folder.
     *
     * @param  FolderInterface $folder
     * @return $this
     */
    public function setFolder(FolderInterface $folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Fired when form is ready to build.
     */
    public function onReady()
    {
        $folder = $this->getFolder();
        $this->setOption('redirect', 'admin/documents/documents/{request.route.parameters.folder}');

        if ($folder && $folder->folder_type == 'minutes') {
            $this->setSkips(
                array_filter($this->getSkips(), function ($skip) {
                    return ($skip != 'granicus');
                })
            );
        }
    }

    /**
     * Fired just before saving the form.
     */
    public function onSaving()
    {
        $entry  = $this->getFormEntry();
        $folder = $this->getFolder();

        if ($folder) {
            $entry->folder_id = $folder->getId();
        }
    }
}

<?php namespace Lwv\DocumentsModule\Folder\Tree;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class FolderTreeBuilder
 */
class FolderTreeBuilder extends TreeBuilder
{
    protected $admin = true;

    /**
     * The tree options.
     *
     * @var array
     */
    protected $options = [
        'tree_view' => 'lwv.module.documents::admin/folder/tree'
    ];

    /**
     * Get the mode.
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the mode.
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * The tree buttons.
     *
     * @var array
     */
    protected $buttons = [
        'add'  => [
            'text'        => 'lwv.module.documents::button.create_child_folder',
            'href'        => 'admin/documents/folders/create?parent={entry.id}',
            'permission'  => 'lwv.module.documents::folders.manage'
        ],
        'documents'  => [
            'text'        => 'lwv.module.documents::button.documents',
            'href'        => 'admin/documents/documents/{entry.id}',
            'class'       => 'btn-info',
            'icon'        => 'file',
            'permission'  => 'lwv.module.documents::documents.manage'
        ],
        'delete' => [
            'attributes' => [
                'data-toggle'  => 'confirm',
                'data-message' => '<h3>Are you sure you want to delete?</h3><p>All child folders and documents below this folder will be deleted.</p>',
            ],
            'permission' => 'lwv.module.documents::folders.manage'
        ],
    ];

}

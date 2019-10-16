<?php namespace Lwv\DocumentsModule\Document\Table;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

class DocumentTableBuilder extends TableBuilder
{
    /**
     * The folder.
     *
     * @var null|FolderInterface
     */
    protected $folder = null;

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'title',
        'entry.private.label',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * Get the folder.
     *
     * @return FolderInterface|null
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the folder.
     *
     * @param $folder
     * @return $this
     */
    public function setFolder(FolderInterface $folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Fired just before starting the query.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $folder = $this->getFolder();

        $query->where('folder_id', $folder->getId());
    }

    /**
     * Fired just before building.
     *
     * @param Builder $query
     */
    public function onReady(Builder $query)
    {
        $folder = $this->getFolder();
        $this->setOption('title',$folder->title);
        $this->setOption('description','<i class="fa fa-folder-open-o">&nbsp;&nbsp;'.$folder->getPath().'</i>');

        if ($folder->folder_type == 'minutes') {
            $this->addColumn('entry.resolutions.count()');
        }
    }

    /**
     * Get the buttons configuration.
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
    }
}

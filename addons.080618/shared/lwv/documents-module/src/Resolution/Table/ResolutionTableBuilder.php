<?php namespace Lwv\DocumentsModule\Resolution\Table;

use Lwv\DocumentsModule\Document\Contract\DocumentInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

class ResolutionTableBuilder extends TableBuilder
{
    /**
     * The document.
     *
     * @var null|DocumentInterface
     */
    protected $document = null;

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
        'number',
        //'entry.passed.label',
        'summary'
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
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
     * Get the document.
     *
     * @return DocumentInterface|null
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set the document.
     *
     * @param $document
     * @return $this
     */
    public function setDocument(DocumentInterface $document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Fired just before starting the query.
     *
     * @param Builder $query
     */
    public function onQuerying(Builder $query)
    {
        $document = $this->getDocument();

        $query->where('minutes_id', $document->getId());
    }

    /**
     * Fired just before building.
     *
     * @param Builder $query
     */
    public function onReady(Builder $query)
    {
        $document = $this->getDocument();

        $this->setOption('title','Resolutions');
        $this->setOption('description','<i><a href="/admin/documents/documents/view/'.$document->id.'" target="_blank">'.$document->folder->getPath().'/'.$document->title.'</a></i>');
    }
}

<?php namespace Lwv\DocumentsModule\Document;

use Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class DocumentRepository extends EntryRepository implements DocumentRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var DocumentModel
     */
    protected $model;

    /**
     * Create a new DocumentRepository instance.
     *
     * @param DocumentModel $model
     */
    public function __construct(DocumentModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find documents by folder.
     *
     * @param $folder
     * @return null|DocumentCollection
     */
    public function findByFolderID($folder, $limit = null)
    {
        return ($limit) ? $this->model->where('folder_id', $folder)->take($limit)->get() : $this->model->where('folder_id', $folder)->get();
    }
}

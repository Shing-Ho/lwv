<?php namespace Lwv\ClubsModule\Document;

use Lwv\ClubsModule\Document\Contract\DocumentRepositoryInterface;
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
     * Find documents by club.
     *
     * @param $id
     * @return null|ClubInterface
     */
    public function findByClub($id)
    {
        return $this->model->where('club_id', $id)->orderBy('sort_order')->get();
    }
}

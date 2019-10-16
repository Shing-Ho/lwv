<?php namespace Lwv\ClubsModule\Photo;

use Lwv\ClubsModule\Photo\Contract\PhotoRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class PhotoRepository extends EntryRepository implements PhotoRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var PhotoModel
     */
    protected $model;

    /**
     * Create a new PhotoRepository instance.
     *
     * @param PhotoModel $model
     */
    public function __construct(PhotoModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find photos by club.
     *
     * @param $id
     * @return null|ClubInterface
     */
    public function findByClub($id)
    {
        return $this->model->where('club_id', $id)->orderBy('sort_order')->get();
    }
}

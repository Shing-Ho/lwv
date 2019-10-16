<?php namespace Lwv\ClubsModule\Header;

use Lwv\ClubsModule\Header\Contract\HeaderRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class HeaderRepository extends EntryRepository implements HeaderRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var HeaderModel
     */
    protected $model;

    /**
     * Create a new HeaderRepository instance.
     *
     * @param HeaderModel $model
     */
    public function __construct(HeaderModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a website by it's club.
     *
     * @param $id
     * @return null|ClubInterface
     */
    public function findByClub($id)
    {
        return $this->model->where('club_id', $id)->first();
    }
}

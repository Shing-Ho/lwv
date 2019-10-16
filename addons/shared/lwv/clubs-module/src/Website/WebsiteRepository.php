<?php namespace Lwv\ClubsModule\Website;

use Lwv\ClubsModule\Website\Contract\WebsiteRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class WebsiteRepository extends EntryRepository implements WebsiteRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var WebsiteModel
     */
    protected $model;

    /**
     * Create a new WebsiteRepository instance.
     *
     * @param WebsiteModel $model
     */
    public function __construct(WebsiteModel $model)
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

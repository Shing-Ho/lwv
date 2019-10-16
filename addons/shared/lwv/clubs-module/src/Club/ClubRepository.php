<?php namespace Lwv\ClubsModule\Club;

use Lwv\ClubsModule\Club\Contract\ClubInterface;
use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Support\Authorizer;
use Auth;

class ClubRepository extends EntryRepository implements ClubRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ClubModel
     */
    protected $model;

    /**
     * Create a new ClubRepository instance.
     *
     * @param ClubModel $model
     */
    public function __construct(ClubModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a folder by it's slug.
     *
     * @param $slug
     * @return null|ClubInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Find all clubs this admin belongs to.
     *
     * @return null|ClubCollection
     */
    public function myClubs()
    {
        $model = new EloquentModel();
        $authorizer = app('Anomaly\Streams\Platform\Support\Authorizer');

        $admin = Auth::user()->isAdmin() || $authorizer->authorize('lwv.module.clubs::clubs.manage');
        
        $clubs = array_map(
                function ($entry) {
                    return $entry['entry_id'];
                },
                $model->setTable('clubs_clubs_admins')->select('entry_id')->where('related_id',Auth::user()->id)->get()->toArray()
        );

        return ($admin) ? $this->model->all() : $this->model->whereIn('id', $clubs)->get();
    }
}

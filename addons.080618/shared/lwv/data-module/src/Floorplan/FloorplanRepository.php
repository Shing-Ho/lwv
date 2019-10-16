<?php namespace Lwv\DataModule\Floorplan;

use Lwv\DataModule\Floorplan\Contract\FloorplanRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class FloorplanRepository extends EntryRepository implements FloorplanRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var FloorplanModel
     */
    protected $model;

    /**
     * Create a new FloorplanRepository instance.
     *
     * @param FloorplanModel $model
     */
    public function __construct(FloorplanModel $model)
    {
        $this->model = $model;
    }
}

<?php namespace Lwv\CareersModule\Job;

use Lwv\CareersModule\Job\Contract\JobRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class JobRepository extends EntryRepository implements JobRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var JobModel
     */
    protected $model;

    /**
     * Create a new JobRepository instance.
     *
     * @param JobModel $model
     */
    public function __construct(JobModel $model)
    {
        $this->model = $model;
    }
}

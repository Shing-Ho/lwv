<?php namespace Lwv\CareersModule\Applicant;

use Lwv\CareersModule\Applicant\Contract\ApplicantRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ApplicantRepository extends EntryRepository implements ApplicantRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ApplicantModel
     */
    protected $model;

    /**
     * Create a new ApplicantRepository instance.
     *
     * @param ApplicantModel $model
     */
    public function __construct(ApplicantModel $model)
    {
        $this->model = $model;
    }
}

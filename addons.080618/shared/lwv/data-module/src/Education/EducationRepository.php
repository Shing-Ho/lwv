<?php namespace Lwv\DataModule\Education;

use Lwv\DataModule\Education\Contract\EducationRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class EducationRepository extends EntryRepository implements EducationRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var EducationModel
     */
    protected $model;

    /**
     * Create a new EducationRepository instance.
     *
     * @param EducationModel $model
     */
    public function __construct(EducationModel $model)
    {
        $this->model = $model;
    }
}

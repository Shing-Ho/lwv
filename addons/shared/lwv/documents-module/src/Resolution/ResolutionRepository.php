<?php namespace Lwv\DocumentsModule\Resolution;

use Lwv\DocumentsModule\Resolution\Contract\ResolutionRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ResolutionRepository extends EntryRepository implements ResolutionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ResolutionModel
     */
    protected $model;

    /**
     * Create a new ResolutionRepository instance.
     *
     * @param ResolutionModel $model
     */
    public function __construct(ResolutionModel $model)
    {
        $this->model = $model;
    }
}

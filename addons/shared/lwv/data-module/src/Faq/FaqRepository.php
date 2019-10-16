<?php namespace Lwv\DataModule\Faq;

use Lwv\DataModule\Faq\Contract\FaqRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class FaqRepository extends EntryRepository implements FaqRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var FaqModel
     */
    protected $model;

    /**
     * Create a new FaqRepository instance.
     *
     * @param FaqModel $model
     */
    public function __construct(FaqModel $model)
    {
        $this->model = $model;
    }
}

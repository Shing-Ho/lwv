<?php namespace Lwv\MessagingModule\Queue;

use Lwv\MessagingModule\Queue\Contract\QueueRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class QueueRepository extends EntryRepository implements QueueRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var QueueModel
     */
    protected $model;

    /**
     * Create a new QueueRepository instance.
     *
     * @param QueueModel $model
     */
    public function __construct(QueueModel $model)
    {
        $this->model = $model;
    }
}

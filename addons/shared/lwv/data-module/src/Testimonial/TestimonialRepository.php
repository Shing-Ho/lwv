<?php namespace Lwv\DataModule\Testimonial;

use Lwv\DataModule\Testimonial\Contract\TestimonialRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class TestimonialRepository extends EntryRepository implements TestimonialRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var TestimonialModel
     */
    protected $model;

    /**
     * Create a new TestimonialRepository instance.
     *
     * @param TestimonialModel $model
     */
    public function __construct(TestimonialModel $model)
    {
        $this->model = $model;
    }
}

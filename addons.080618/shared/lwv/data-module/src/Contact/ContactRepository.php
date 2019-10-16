<?php namespace Lwv\DataModule\Contact;

use Lwv\DataModule\Contact\Contract\ContactRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class ContactRepository extends EntryRepository implements ContactRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var ContactModel
     */
    protected $model;

    /**
     * Create a new ContactRepository instance.
     *
     * @param ContactModel $model
     */
    public function __construct(ContactModel $model)
    {
        $this->model = $model;
    }
}

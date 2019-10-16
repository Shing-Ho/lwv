<?php namespace Lwv\NewsModule\Type;

use Lwv\NewsModule\Type\Command\CreateTypeStream;
use Lwv\NewsModule\Type\Command\DeleteTypeStream;
use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class TypeObserver
 */
class TypeObserver extends EntryObserver
{

    /**
     * Fired after a page type is created.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        $this->commands->dispatch(new CreateTypeStream($entry));

        parent::created($entry);
    }

    /**
     * Fired after a page type is deleted.
     *
     * @param EntryInterface|TypeInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        $this->commands->dispatch(new DeleteTypeStream($entry));

        parent::deleted($entry);
    }
}

<?php namespace Lwv\ClubsModule\Post;

use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Lwv\ClubsModule\Post\Command\DeleteFile;

class PostObserver extends EntryObserver
{
    /**
     * Fired before saving the entry.
     *
     * @param  EntryInterface|FileInterface $entry
     * @return bool
     */
    public function saving(EntryInterface $entry)
    {
        // Updating an existing photo
        if ($entry->id) {
            $model = new PostModel();
            $existing = $model->find($entry->id);

            // Replacing the file
            if ($entry->image_id != $existing->image_id) {
                $this->dispatch(new DeleteFile($existing));
            }
        }

        return parent::saving($entry);
    }

    /**
     * Fired after the entry is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteFile($entry));

        parent::deleting($entry);
    }
}

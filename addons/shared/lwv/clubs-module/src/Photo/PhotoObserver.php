<?php namespace Lwv\ClubsModule\Photo;

use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Lwv\ClubsModule\Photo\Command\DeleteFile;

class PhotoObserver extends EntryObserver
{
    /**
     * Fired before saving the file.
     *
     * @param  EntryInterface|FileInterface $entry
     * @return bool
     */
    public function saving(EntryInterface $entry)
    {
        // Updating an existing photo
        if ($entry->id) {
            $model = new PhotoModel();
            $existing = $model->find($entry->id);

            // Replacing the file
            if ($entry->photo_id != $existing->photo_id) {
                $this->dispatch(new DeleteFile($existing));
            }
        }

        return parent::saving($entry);
    }

    /**
     * Fired after a photo is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteFile($entry));

        parent::deleting($entry);
    }
}

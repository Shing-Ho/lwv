<?php namespace Lwv\ClubsModule\Document;

use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Lwv\ClubsModule\Document\Command\DeleteFile;

class DocumentObserver extends EntryObserver
{
    /**
     * Fired before saving the file.
     *
     * @param  EntryInterface|FileInterface $entry
     * @return bool
     */
    public function saving(EntryInterface $entry)
    {
        // Updating an existing document
        if ($entry->id) {
            $model = new DocumentModel();
            $existing = $model->find($entry->id);

            // Replacing the file
            if ($entry->document_id != $existing->document_id) {
                $this->dispatch(new DeleteFile($existing));
            }
        }

        return parent::saving($entry);
    }

    /**
     * Fired after a document is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteFile($entry));

        parent::deleting($entry);
    }
}

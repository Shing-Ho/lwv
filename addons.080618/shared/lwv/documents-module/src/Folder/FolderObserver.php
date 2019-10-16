<?php namespace Lwv\DocumentsModule\Folder;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Lwv\DocumentsModule\Folder\Command\SetPath;
use Lwv\DocumentsModule\Folder\Command\UpdatePaths;

class FolderObserver extends EntryObserver
{
    /**
     * Fired before saving the folder.
     *
     * @param EntryInterface $entry
     */
    public function saving(EntryInterface $entry)
    {
        $this->dispatch(new SetPath($entry));

        parent::saving($entry);
    }

    /**
     * Fired after saving the folder.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        $this->dispatch(new UpdatePaths($entry));

        parent::saved($entry);
    }

    /**
     * Fired after a folder is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        // Delete child folders
        foreach ($entry->getChildren() as $child) {
            $child->delete();
        }

        // Delete child documents
        foreach ($entry->getDocuments() as $document) {
            $document->delete();
        }

        parent::deleted($entry);
    }
}

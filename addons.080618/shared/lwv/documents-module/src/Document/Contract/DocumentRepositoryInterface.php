<?php namespace Lwv\DocumentsModule\Document\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Lwv\DocumentsModule\Document\DocumentCollection;

interface DocumentRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find documents by folder.
     *
     * @param $folder
     * @return null|DocumentCollection
     */
    public function findByFolderID($folder);
}

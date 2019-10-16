<?php namespace Lwv\DocumentsModule\Folder\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface FolderRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find a folder by it's slug.
     *
     * @param $slug
     * @return null|FolderInterface
     */
    public function findBySlug($slug);

    /**
     * Find a folder by it's path.
     *
     * @param $path
     * @return null|FolderInterface
     */
    public function findByPath($path);
}

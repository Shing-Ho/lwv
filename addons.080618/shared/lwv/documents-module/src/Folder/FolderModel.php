<?php namespace Lwv\DocumentsModule\Folder;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\Documents\DocumentsFoldersEntryModel;
use Lwv\DocumentsModule\Resolution\ResolutionCollection;

class FolderModel extends DocumentsFoldersEntryModel implements FolderInterface
{
    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Check if documents exist
     *
     * @return bool
     */
    public function hasDocuments()
    {
        $documents = app('Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface');
        return !$documents->findByFolderID($this->id,1)->isEmpty();
    }

    /**
     * Get the documents.
     *
     * @return collection
     */
    public function getDocuments()
    {
        $documents = app('Lwv\DocumentsModule\Document\Contract\DocumentRepositoryInterface');
        return $documents->findByFolderID($this->id);
    }

    /**
     * Get the related parent folder.
     *
     * @return null|FolderInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the parent ID.
     *
     * @return int|null
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * Get the path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the related children folders.
     *
     * @return FolderCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Return the children folders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany('Lwv\DocumentsModule\Folder\FolderModel', 'parent_id', 'id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the documents relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany('Lwv\DocumentsModule\Document\DocumentModel', 'folder_id', 'id')
            ->orderBy('sort_order', 'ASC');
    }

    /**
     * Return the resolutions stored in documents.
     */
    public function resolutions()
    {
        $resolutions = new ResolutionCollection();

        foreach ($this->getDocuments() as $document) {
            $resolutions = $resolutions->merge($document->resolutions()->get());
        }

        return $resolutions->sortByDesc(function ($resolution) {
            return (int) str_replace('-','',$resolution->number);
        });
    }
}

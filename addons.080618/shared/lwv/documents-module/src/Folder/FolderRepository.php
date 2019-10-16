<?php namespace Lwv\DocumentsModule\Folder;

use Lwv\DocumentsModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class FolderRepository extends EntryRepository implements FolderRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var FolderModel
     */
    protected $model;

    /**
     * Create a new FolderRepository instance.
     *
     * @param FolderModel $model
     */
    public function __construct(FolderModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a folder by it's slug.
     *
     * @param $slug
     * @return null|FolderInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * Find a folder by it's path.
     *
     * @param $path
     * @return null|FolderInterface
     */
    public function findByPath($path)
    {
        return $this->model->where('path', $path)->first();
    }
}

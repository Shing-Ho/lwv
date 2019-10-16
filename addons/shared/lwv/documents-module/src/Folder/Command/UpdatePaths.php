<?php namespace Lwv\DocumentsModule\Folder\Command;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;
use Lwv\DocumentsModule\Folder\Contract\FolderRepositoryInterface;


/**
 * Class UpdatePaths
 */
class UpdatePaths
{

    /**
     * The page instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new UpdatePaths instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     *
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FolderRepositoryInterface $folders)
    {
        foreach ($this->folder->getChildren() as $folder) {
            if ($folder instanceof FolderInterface) {
                $folders->save(
                    $folder->setAttribute(
                        'path',
                        $this->folder->getPath(). '/' . $folder->getSlug()
                    )
                );
            }
        }
    }
}

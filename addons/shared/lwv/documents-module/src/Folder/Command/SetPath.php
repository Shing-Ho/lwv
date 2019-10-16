<?php namespace Lwv\DocumentsModule\Folder\Command;

use Lwv\DocumentsModule\Folder\Contract\FolderInterface;


/**
 * Class SetPath
 */
class SetPath
{

    /**
     * The page instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new SetPath instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if ($parent = $this->folder->getParent()) {
            $path = $parent->getPath() . '/' . $this->folder->getSlug();
        } else {
            $path = '/' . $this->folder->getSlug();
        }

        $this->folder->setAttribute('path', $path);
    }
}

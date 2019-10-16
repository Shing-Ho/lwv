<?php namespace Lwv\ClubsModule\Post\Command;

use Anomaly\FilesModule\File\FileModel;
use Lwv\ClubsModule\Post\Contract\PostInterface;
use Lwv\ClubsModule\Post\PostModel;
use DB;

/**
 * Class DeleteFile
 */
class DeleteFile
{

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    protected $post;

    /**
     * Create a new DeleteFile instance.
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command.
     */
    public function handle(PostModel $post, FileModel $files)
    {
        if (!$file = $this->post->image) {
            return;
        }
        $folder = $file->folder;

        // Photos linked to the same file ID
        $linked = $post->where('id','!=',$this->post->id)->where('image_id',$file->id)->get();

        // Photos linked to the same file resource
        $conflicts = $files->where('id','!=',$file->id)
            ->where('folder_id',$folder->id)
            ->where('name',$file->name)
            ->get();

        if ($linked->isEmpty()) {
            if ($conflicts->isEmpty()) {
                $file->forceDelete();
            } else {
                $file->delete();
            }
        }
    }
}

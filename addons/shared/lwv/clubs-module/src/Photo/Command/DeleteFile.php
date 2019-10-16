<?php namespace Lwv\ClubsModule\Photo\Command;

use Anomaly\FilesModule\File\FileModel;
use Lwv\ClubsModule\Photo\Contract\PhotoInterface;
use Lwv\ClubsModule\Photo\PhotoModel;
use DB;

/**
 * Class DeleteFile
 */
class DeleteFile
{

    /**
     * The photo instance.
     *
     * @var PhotoInterface
     */
    protected $photo;

    /**
     * Create a new DeleteFile instance.
     */
    public function __construct(PhotoInterface $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Handle the command.
     */
    public function handle(PhotoModel $photos, FileModel $files)
    {
        $file = $this->photo->image;
        $folder = $file->folder;

        // Photos linked to the same file ID
        $linked = $photos->where('id','!=',$this->photo->id)->where('image_id',$file->id)->get();

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

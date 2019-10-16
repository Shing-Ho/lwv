<?php namespace Lwv\ClubsModule\Document\Command;

use Anomaly\FilesModule\File\FileModel;
use Lwv\ClubsModule\Document\Contract\DocumentInterface;
use Lwv\ClubsModule\Document\DocumentModel;
use DB;

/**
 * Class DeleteFile
 */
class DeleteFile
{

    /**
     * The document instance.
     *
     * @var DocumentInterface
     */
    protected $document;

    /**
     * Create a new DeleteFile instance.
     */
    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    /**
     * Handle the command.
     */
    public function handle(DocumentModel $documents, FileModel $files)
    {
        $file = $this->document->document;
        $folder = $file->folder;

        // Documents linked to the same file ID
        $linked = $documents->where('id','!=',$this->document->id)->where('document_id',$file->id)->get();

        // Documents linked to the same file resource
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

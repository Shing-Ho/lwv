<?php namespace Lwv\DocumentsModule\Document\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Anomaly\FilesModule\Folder\FolderModel;
use Anomaly\FilesModule\File\FileModel;
use Lwv\DocumentsModule\Document\DocumentModel;
use DB;

/**
 * Class Status
 *
 * Locate files in the documents folder not linked to documents and remove
 *
 */
class Status extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'documents:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report health status for document handler';
    
    /**
     * Execute the console command.
     */
    public function fire(FolderModel $folders, FileModel $files, DocumentModel $documents)
    {
        $clean = true;

        $this->info('-- Executing ('.$this->name.')');

        if ($folder = $folders->where('slug','documents')->first()) {
            $folder_files = array_map(
                function ($result) {
                    return $result->id;
                },
                DB::table('files_files')->where('folder_id',$folder->id)->get(['id'])->toArray()
            );

            $linked = array_map(
                function ($result) {
                    return $result->document_id;
                },
                DB::table('documents_documents')->get(['document_id'])->toArray()
            );

            $garbage = array_filter(
                $folder_files,
                function ($result) use ($linked) {
                    return !in_array($result,$linked);
                }
            );

            $unlinked = [];
            foreach ($documents->all() as $document) {
                if (!$document->document || !$document->document->resource()) {
                    $unlinked[] = $document;
                }
            }

            $this->info('Documents In Repository = '.$documents->all()->count());
            $this->info('Files in Documents Folder = '.count($folder_files));

            // Files in documents folder not linked to documents
            if (count($garbage)) {
                $clean = false;

                $this->error('Files found in documents folder not linked to documents');

                foreach ($garbage as $id) {
                    if ($file = $files->withTrashed()->find($id)) {
                        $this->error($file->id.' | '.$file->name);
                    }
                }
            }

            // Documents not linked to files
            if (count($unlinked)) {
                $clean = false;

                $this->error('Documents found with missing files');

                foreach ($unlinked as $document) {
                    $this->error($document->folder->getPath().'/'.$document->title);
                }
            }


        } else {
            $this->error('Unable to locate documents folder');
        }

        if ($clean) {
            $this->info('Document handler is clean');
        }
    }
}


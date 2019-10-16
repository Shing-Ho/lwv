<?php namespace Lwv\DocumentsModule\Document\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\DocumentsModule\Document\DocumentModel;
use Lwv\DropzoneFieldType\File\FileUploader;
use DB;
use Carbon\Carbon;

/**
 * Class LoadFiles
 *
 * Step 2
 */
class LoadFiles extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'documents:load_files';

    protected $file_root = '/data/lwv/documents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load document files into the Files module';
    
    /**
     * Execute the console command.
     */
    public function fire(FileUploader $uploader)
    {
        $this->info('-- Executing ('.$this->name.')');
        $entries = DB::table('load_documents')->whereNull('document_id')->get();

        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {
            copy($this->file_root.$entry->file, '/tmp/'.$entry->file_name);
            $uploads = ['tmp::'.$entry->file_name];
            $files = $uploader->upload($uploads,'documents');
            $file = $files->first();

            DB::table('load_documents')
                ->where('file', $entry->file)
                ->update(
                    [
                        'file_id' => $file->id,
                    ]
                );

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}


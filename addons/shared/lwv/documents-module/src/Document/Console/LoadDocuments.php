<?php namespace Lwv\DocumentsModule\Document\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\DocumentsModule\Document\DocumentModel;
use DB;

/**
 * Class LoadDocuments
 *
 * Step 3
 */
class LoadDocuments extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'documents:load_documents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load documents from load_documents metadata table';
    
    /**
     * Execute the console command.
     */
    public function fire()
    {
        $this->info('-- Executing ('.$this->name.')');
        $entries = DB::table('load_documents')->whereNull('document_id')->get();

        $this->info('-- Loading Documents');
        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {
            $document = new DocumentModel();
            $document->sort_order = $entry->sort_order;
            $document->created_at = $entry->file_date;
            $document->created_by_id = 1;
            $document->title = $entry->title;
            $document->folder_id = $entry->folder_id;
            $document->description = $entry->title;
            $document->document_id = $entry->file_id;
            $document->private = $entry->private;
            $document->save();

            $entry->document_id = $document->id;

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}


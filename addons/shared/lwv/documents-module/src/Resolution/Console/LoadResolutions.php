<?php namespace Lwv\DocumentsModule\Resolution\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\DocumentsModule\Resolution\ResolutionModel;
use Lwv\DocumentsModule\Document\DocumentModel;
use DB;
use Carbon\Carbon;

/**
 * Class LoadResolutions
 *
 * Step 2
 */
class LoadResolutions extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'resolutions:load_resolutions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load resolutions from load_resolutions table';
    
    /**
     * Execute the console command.
     */
    public function fire(DocumentModel $documents)
    {
        $this->info('-- Executing ('.$this->name.')');
        $entries = DB::table('load_resolutions')->whereNotNull('file_document_id')->get();

        $this->info('-- Truncating Resolutions Table');
        ResolutionModel::truncate();

        $this->info('-- Loading Resolutions');
        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {
            $document = $documents->find($entry->file_document_id);
            $resolution = new ResolutionModel();
            $resolution->created_at = $document->created_at;
            $resolution->created_by_id = 1;
            $resolution->number = $entry->resolution_number;
            $resolution->summary = (strlen($entry->description) > 496) ? substr($entry->description,0,496).' ...' : $entry->description;
            $resolution->minutes_id = $entry->file_document_id;
            $resolution->save();

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}

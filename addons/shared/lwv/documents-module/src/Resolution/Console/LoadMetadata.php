<?php namespace Lwv\DocumentsModule\Resolution\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\DocumentsModule\Document\DocumentModel;
use Mmanos\Search\Search;
use DB;
use Carbon\Carbon;

/**
 * Class LoadMetadata
 *
 * Step 1
 */
class LoadMetadata extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'resolutions:load_metadata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load resolution metadata into load_resolutions table';
    
    /**
     * Execute the console command.
     */
    public function fire(DocumentModel $documents, Search $search)
    {
        $this->info('-- Executing ('.$this->name.')');
        $entries = DB::table('load_resolutions')->get();

        $this->info('-- Setting Metadata Fields');
        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {
            $file_name = substr($entry->file_name, strrpos($entry->file_name, '\\') + 1);
            $suffix = (strpos($file_name, '.')) ? strpos($file_name, '.') : strlen($file_name);
            $file_basename = substr($file_name, 0, $suffix);

            DB::table('load_resolutions')
                ->where('id', $entry->id)
                ->update(
                    [
                        'file_basename' => $this->cleanse($file_basename),
                    ]
                );

            $this->output->progressAdvance();
        }
        $this->output->progressFinish();

        #########

        $entries = $documents->all();
        $this->info('-- Matching Documents On File Name');

        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {
            $file_name = $entry->document->name;
            $suffix = (strpos($file_name, '.')) ? strpos($file_name, '.') : strlen($file_name);
            $file_basename = substr($file_name, 0, $suffix);

            DB::table('load_resolutions')
                ->where('file_basename', $this->cleanse($file_basename))
                ->update(
                    [
                        'file_document_id' => $entry->id,
                    ]
                );

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        ###########
        return;
        ###########

        $entries = DB::table('load_resolutions')->whereNull('file_document_id')->get();
        $this->info('-- Matching Documents On Search');

        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {

            $results = $search
                ->index('documents')
                ->search(['title','content'], $entry->resolution_number)
                ->get();

            if (count($results)) {
                $result = array_shift($results);

                DB::table('load_resolutions')
                    ->where('id', $entry->id)
                    ->update(
                        [
                            'search_document_id' => $result['id'],
                        ]
                    );
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

    }

    private function cleanse($file_name) {
        $garbage = ['(1)','(2)','(3)'];

        foreach ($garbage as $token) {
            $file_name = str_replace($token,'',$file_name);
        }

        return trim($file_name);
    }
}

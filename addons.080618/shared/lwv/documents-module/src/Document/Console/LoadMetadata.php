<?php namespace Lwv\DocumentsModule\Document\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Lwv\DocumentsModule\Folder\FolderModel;
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
    protected $name = 'documents:load_metadata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load document metadata into load_documents table';
    
    /**
     * Execute the console command.
     */
    public function fire(FolderModel $folders)
    {
        $this->info('-- Executing ('.$this->name.')');
        $entries = DB::table('load_documents')->whereNull('document_id')->get();

        $this->info('-- Setting Metadata Fields');
        $this->output->progressStart($entries->count());

        $document_type = $entries->first()->document_type;

        foreach ($entries as $entry) {
            $file_name = substr($entry->file, strrpos($entry->file, '/') + 1);
            $file_path = substr($entry->file, 0, strrpos($entry->file, '/'));

            if ($document_type == 'minutes') {
                preg_match("/(\d{4}-\d{2}-\d{2})/", $file_name, $match);
                $file_date = (count($match)) ? Carbon::createFromFormat('Y-m-d H', $match[0].' 00') : null;
                $title = $this->getBoard(strtolower($entry->file)).' Board Minutes';
                $title .= ($this->getMeetingType(strtolower($entry->file))) ? ' '.$this->getMeetingType(strtolower($entry->file)) : '';
                $title .= ' '.$file_date->format('m-d-Y');
            } else {
                $title = $file_name;
                $file_date = Carbon::now();
            }

            if ($folder = $folders->where('path',$file_path)->first()) {
                $folder_id = $folder->id;
            } else {
                $folder_id = null;
            }

            DB::table('load_documents')
                ->where('file', $entry->file)
                ->update(
                    [
                        'file_name' => $file_name,
                        'file_path' => $file_path,
                        'file_date' => $file_date,
                        'title' => $title,
                        'description' => 'Bulk Website Load',
                        'private' => 0,
                        'folder_id' => $folder_id,
                    ]
                );

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        // Set sort order for each folder
        if ($document_type == 'minutes') {
            // Sort by date
            $entries = DB::table('load_documents')->whereNull('document_id')->orderBy('folder_id')->orderBy('file_date','DESC')->get();
        } else {
            // Sort alphabetically
            $entries = DB::table('load_documents')->whereNull('document_id')->orderBy('folder_id')->orderBy('file_name')->get();
        }


        $x = 1;
        $f = 0;

        $this->info('-- Setting Sort Order');
        $this->output->progressStart($entries->count());

        foreach ($entries as $entry) {
            $x = ($f == $entry->folder_id) ? $x+1 : 1;

            DB::table('load_documents')
                ->where('file', $entry->file)
                ->update(
                    [
                        'sort_order' => $x,
                    ]
                );

            $this->output->progressAdvance();
            $f = $entry->folder_id;
        }

        $this->output->progressFinish();
    }

    private function getBoard($file) {
        if (strpos($file,'corporate')) {
            return 'Corporate Members';
        } elseif (strpos($file,'grf')) {
            return 'GRF';
        } elseif (strpos($file,'united')) {
            return 'United';
        } elseif (strpos($file,'third')) {
            return 'Third';
        } elseif (strpos($file,'mutual50')) {
            return 'Mutual 50';
        } elseif (strpos($file,'vms')) {
            return 'VMS';
        }
    }

    private function getMeetingType($file) {
        $type = '';
        $type .= (strpos($file,'open')) ? ' Open' : '';
        $type .= (strpos($file,'closed')) ? ' Closed' : '';
        $type .= (strpos($file,'spec')) ? ' Special' : '';
        $type .= (strpos($file,'emergency')) ? ' Emergency' : '';
        $type .= (strpos($file,'election')) ? ' Election' : '';
        $type .= (strpos($file,'annual')) ? ' Annual' : '';
        $type .= (strpos($file,'organizational')) ? ' Organizational' : '';
        $type .= (strpos($file,'budge')) ? ' Budget' : '';
        $type .= (strpos($file,'action by consent')) ? ' Action By Consent' : '';
        $type .= (strpos($file,'reconvened')) ? ' Reconvened' : '';
        $type .= (strpos($file,'action without')) ? ' Action Without Meeting' : '';
        $type .= (strpos($file,'land use')) ? ' Land Use' : '';
        $type .= (strpos($file,'bylaws')) ? ' Bylaws' : '';

        return ltrim($type,' ');
    }
}

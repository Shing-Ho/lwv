<?php namespace Lwv\SearchModule\Search\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Config\Repository;
use Symfony\Component\Console\Input\InputArgument;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\DocumentsModule\Document\DocumentModel;
use Lwv\SearchModule\Search\Command\GetConfig;
use Lwv\SearchModule\Search\Command\DestroyIndex;
use Lwv\SearchModule\Search\Command\IndexDocument;
use Lwv\SearchModule\Search\Command\IndexPage;
use Lwv\SearchModule\Search\Command\IndexPost;
use Lwv\SearchModule\Search\Command\ResetPermissions;


/**
 * Class Rebuild
 */
class Rebuild extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'search:rebuild';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild search index.';

    /**
     * Execute the console command.
     */
    public function fire(
        PageModel $pages,
        DocumentModel $documents
    ) {
        $index = ($this->argument('index')) ? $this->argument('index') : 'default';

        $this->info('-- Executing ('.$this->name.')');
        
        // Rebuild index
        $this->info('Destroying search index ('.$index.')');
        $this->dispatch(new DestroyIndex($index));

        $this->info('Rebuilding search index ('.$index.')');

        if ($index == 'default') {
            /*
             * Index pages
             */
            $this->info('Indexing Pages');

            $entries = $pages->all()->filter(function ($item) {
                // Only pages that are enabled and searchable
                if ($item->isEnabled() && $item->getEntry()->searchable) {
                    return $item;
                }
            });
            
            $this->output->progressStart($entries->count());

            foreach($entries as $entry) {
                $this->dispatch(new IndexPage($entry));
                $this->output->progressAdvance();
            }

            $this->output->progressFinish();

            /*
             * Index Posts
             */
            $this->info('Indexing Posts');
            $config = $this->dispatch(new GetConfig('posts'));
            $entries = new Collection();

            foreach (array_keys($config) as $class) {
                $model = new $class();
                $entries = $entries->merge($model->live()->get());
            }

            $this->output->progressStart($entries->count());

            foreach($entries as $entry) {
                $this->dispatch(new IndexPost($entry));
                $this->output->progressAdvance();
            }

            $this->output->progressFinish();

        } elseif ($index == 'documents') {
            /*
             * Index Documents
             */
            $entries = $documents->all()->filter(function ($item) {
                // Only documents in enabled / searchable folders
                if ($item->folder->enabled && $item->folder->searchable) {
                    return $item;
                }
            });

            $this->output->progressStart($entries->count());

            foreach ($entries as $entry) {
                $this->dispatch(new IndexDocument($entry));
                $this->output->progressAdvance();
            }

            $this->output->progressFinish();
        } else {
            abort(500,'Unsupported Index');
        }

        // Reset index permissions
        $this->dispatch(new ResetPermissions($index));
        $this->info('Index permissions reset ('.$index.')');
    }

    /**
     * Get the command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['index', InputArgument::OPTIONAL, 'The index to rebuilt.'],
        ];
    }
}

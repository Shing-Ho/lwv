<?php namespace Lwv\SearchModule\Search\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Contracts\Config\Repository;
use Symfony\Component\Console\Input\InputArgument;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\DocumentsModule\Document\DocumentModel;
use Lwv\SearchModule\Search\Command\GetConfig;
use Lwv\SearchModule\Search\Index\IndexManager;
use Lwv\SearchModule\Search\Command\IndexDocument;
use Lwv\SearchModule\Search\Command\IndexPage;
use Lwv\SearchModule\Search\Command\IndexPost;
use Lwv\SearchModule\Search\Command\ResetPermissions;
use Mmanos\Search\Search;

/**
 * Class Refresh
 */
class Refresh extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'search:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh search index.';

    /**
     * Execute the console command.
     */
    public function fire(
        Repository $config,
        PageModel $pages,
        DocumentModel $documents,
        IndexManager $indexManager,
        Search $search
    ) {
        $index = ($this->argument('index')) ? $this->argument('index') : 'default';
        $indexManager->setIndex($index);

        $this->info('-- Executing ('.$this->name.')');
        
        // Rebuild index

        $this->info('Refreshing search index ('.$index.')');

        if ($index == 'default') {
            /*
             * Index pages
             */
            $this->info('Indexing Pages');

            $entries = $pages->all()->filter(function ($item) use ($search) {
                // Only pages that are enabled and 
                if ($item->isEnabled() && $item->getEntry()->searchable) {
                    // Only pages with missing index entries
                    //$this->info('Index item:'.$item->slug.', Enabled:'.$item->isEnabled().' searchable:'.$item->getEntry()->searchable.' , Missing:'.count($search->search('page',$item->id)->get()));
                    if (!count($search->search('page',$item->id)->get())) {
                        return $item;
                    }
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

            foreach ($config as $class => $cfg) {
                $model = new $class();
                $fieldIx = $cfg['namespace'].$cfg['stream'];

                $entries = $entries->merge(
                        $model->live()->get()->filter(
                            function ($item) use ($search,$fieldIx) {
                            // Only posts with missing index entries
                            if (!count($search->search($fieldIx,$item->id)->get())) {
                                return $item;
                            }}
                        )
                    );
            }

            $this->output->progressStart($entries->count());

            foreach($entries as $entry) {
                $this->dispatch(new IndexPost($entry));
                $this->output->progressAdvance();
            }

            $this->output->progressFinish();

        } elseif ($index == 'documents') {
            // Index Documents
            $entries = $documents->all()->filter(function ($item) use ($indexManager) {
                // Only documents in enabled / searchable folders
                if ($item->folder->enabled && $item->folder->searchable) {
                    // Only documents with missing entries
                    if (!$indexManager->exists(['id' => $item->id])) {
                        return $item;
                    }
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

    private function getMissing() {

    }
}

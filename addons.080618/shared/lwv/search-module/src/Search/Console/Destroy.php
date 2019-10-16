<?php namespace Lwv\SearchModule\Search\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\Console\Input\InputArgument;
use Lwv\SearchModule\Search\Command\DestroyIndex;

/**
 * Class Destroy
 */
class Destroy extends Command
{

    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'search:destroy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy the search index.';

    /**
     * Execute the console command.
     */
    public function fire()
    {
        $index = ($this->argument('index')) ? $this->argument('index') : 'default';

        $this->info('-- Executing ('.$this->name.')');
        $this->dispatch(new DestroyIndex($index));
        $this->info('Search index "'.$index.'" destroyed!');
    }

    /**
     * Get the command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['index', InputArgument::OPTIONAL, 'The index to destroy.'],
        ];
    }
}

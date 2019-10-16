<?php namespace Lwv\SearchModule\Search\Command;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Lwv\SearchModule\Search\Index\IndexManager;

/**
 * Class DestroyIndex
 */
class DestroyIndex
{
    use DispatchesJobs;

    /**
     * The index.
     */
    protected $index;

    /**
     * Create a new DestroyIndex instance.
     */
    public function __construct($index)
    {
        $this->index = $index;
    }

    /**
     * Handle the command.
     */
    public function handle(IndexManager $index)
    {
        $index->setIndex($this->index);
        $index->destroy();
    }
}

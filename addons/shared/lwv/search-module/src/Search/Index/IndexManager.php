<?php namespace Lwv\SearchModule\Search\Index;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Mmanos\Search\Index;
use Mmanos\Search\Search;

/**
 * Class IndexManager
 */
class IndexManager
{

    use DispatchesJobs;

    /**
     * The search utility.
     *
     * @var Search
     */
    protected $search;

    /**
     * The index.
     */
    protected $index = 'default';

    /**
     * Create a new IndexManager instance.
     *
     * @param Search|Search $search
     */
    public function __construct(Search $search)
    {
        $this->search = $search;
    }

    /**
     * Set the index.
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * Get the index.
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Insert a search index item.
     */
    public function insert($entry)
    {
        $this->search->index($this->index)->delete(array_get($entry, 'id'));
        if (array_get($entry, 'enabled', true) === false) {
            return;
        }
        $this->search->index($this->index)->insert(
            array_get($entry, 'id'),
            array_get($entry, 'fields'),
            array_get($entry, 'extra')
        );
    }

    /**
     * Delete the item from the search index.
     */
    public function delete($entry)
    {
        $this->search->index($this->index)->delete(array_get($entry, 'id'));
    }

    /**
     * Delete the item from the search index by specified field
     */
    public function deleteBy($entry)
    {
        $this->search->index($this->index)->search(array_get($entry, 'field'),array_get($entry, 'value'))->delete();
    }

    /**
     * Check if key exists in the search index.
     */
    public function exists($entry)
    {
        return $this->search->index($this->index)->exists(array_get($entry, 'id'));
    }

    /**
     * Destroy the index.
     */
    public function destroy()
    {
        $this->search->index($this->index)->deleteIndex();
    }
}

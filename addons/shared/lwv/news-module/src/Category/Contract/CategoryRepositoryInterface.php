<?php namespace Lwv\NewsModule\Category\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface CategoryRepositoryInterface
 */
interface CategoryRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a category by it's slug.
     *
     * @param $slug
     * @return null|CategoryInterface
     */
    public function findBySlug($slug);

    /**
     * All categories
     *
     * @return null|CategoryInterface
     */
    public function all();
}

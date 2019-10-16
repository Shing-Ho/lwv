<?php namespace Lwv\NewsModule\Type\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface TypeRepositoryInterface
 */
interface TypeRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a category by it's slug.
     *
     * @param $slug
     * @return null|TypeInterface
     */
    public function findBySlug($slug);
}

<?php namespace Lwv\ClubsModule\Club\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Lwv\ClubsModule\Club\ClubCollection;

interface ClubRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find a club by it's slug.
     *
     * @param $slug
     * @return null|ClubInterface
     */
    public function findBySlug($slug);

    /**
     * Find all clubs this admin belongs to.
     *
     * @return null|ClubCollection
     */
    public function myClubs();
}

<?php namespace Lwv\ClubsModule\Website\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface WebsiteRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find a website by it's club.
     *
     * @param $id
     * @return null|ClugInterface
     */
    public function findByClub($id);
}

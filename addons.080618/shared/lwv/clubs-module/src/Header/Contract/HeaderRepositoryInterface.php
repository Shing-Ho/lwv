<?php namespace Lwv\ClubsModule\Header\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface HeaderRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find a website by it's club.
     *
     * @param $id
     * @return null|ClugInterface
     */
    public function findByClub($id);
}

<?php namespace Lwv\ClubsModule\Document\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface DocumentRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find documents by club.
     *
     * @param $id
     * @return null|ClugInterface
     */
    public function findByClub($id);
}

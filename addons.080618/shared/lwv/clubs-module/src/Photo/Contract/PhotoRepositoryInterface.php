<?php namespace Lwv\ClubsModule\Photo\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface PhotoRepositoryInterface extends EntryRepositoryInterface
{
    /**
     * Find photos by club.
     *
     * @param $id
     * @return null|ClugInterface
     */
    public function findByClub($id);
}

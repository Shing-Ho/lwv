<?php namespace Lwv\ClubsModule\Post\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface PostRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a post by it's slug.
     */
    public function findBySlug($cid,$slug);

    /**
     * Find many posts by date.
     */
    public function findManyByDate($cid, $type, $year, $month = null, $limit = null);

    /**
     * Get recent posts.
     *
     * @param null $limit
     * @return PostCollection
     */
    public function getRecent($cid, $type, $limit = null);

    /**
     * Get live posts.
     *
     * @return PostCollection
     */
    public function getLive($cid, $type);
}

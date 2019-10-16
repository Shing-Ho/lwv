<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Cache;

/**
 * Class PostObserver
 */
class PostObserver extends EntryObserver
{

    /**
     * Fired just before saving the entry.
     *
     * @param EntryInterface $entry
     */
    public function creating(EntryInterface $entry)
    {
        /* @var PostInterface $entry */
        if (!$entry->getStrId()) {
            $entry->setAttribute('str_id', str_random());
        }

        parent::creating($entry);
    }

    /**
     * Fired after saving the post.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        // Purge cache
        $cacheKeys = array('news_sidebar');

        foreach ($cacheKeys as $cacheKey) {
            Cache::forget($cacheKey);
        }

        parent::saved($entry);
    }

    /**
     * Fired after a post is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        // Purge cache
        $cacheKeys = array('news_sidebar');

        foreach ($cacheKeys as $cacheKey) {
            Cache::forget($cacheKey);
        }

        parent::deleted($entry);
    }
}

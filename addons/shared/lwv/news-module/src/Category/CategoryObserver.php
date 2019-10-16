<?php namespace Lwv\NewsModule\Category;

use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Cache;

/**
 * Class CategoryObserver
 */
class CategoryObserver extends EntryObserver
{

    /**
     * Fired after saving the category.
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
     * Fired after a category is deleted.
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

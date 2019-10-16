<?php namespace Lwv\BlockCustomExtension\Block;

use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlocksModule\Block\Command\PurgeBlockCache;

class BlockObserver extends EntryObserver
{
    protected $blocks;

    /**
     * Fired after saving the block.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        // Retrieve page
        $page = PageModel::find($entry->page);

        // Dump the block cache for this page
        $this->dispatch(new PurgeBlockCache($page));

        parent::saved($entry);
    }

    /**
     * Fired after a block is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        // Retrieve page
        $page = PageModel::find($entry->page);

        // Dump the block cache for this page
        $this->dispatch(new PurgeBlockCache($page));

        parent::deleted($entry);
    }
}

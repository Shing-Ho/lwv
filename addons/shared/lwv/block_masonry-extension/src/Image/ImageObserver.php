<?php namespace Lwv\BlockMasonryExtension\Image;

use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\PagesModule\Page\PageModel;
use Lwv\BlockMasonryExtension\Block\BlockModel;
use Lwv\BlocksModule\Block\Command\PurgeBlockCache;

class ImageObserver extends EntryObserver
{
    /**
     * Fired after saving the image.
     *
     * @param EntryInterface $entry
     */
    public function saved(EntryInterface $entry)
    {
        // Retrieve page
        $block = BlockModel::find($entry->block);
        $page = PageModel::find($block->page);

        // Dump the block cache for this page
        $this->dispatch(new PurgeBlockCache($page));

        parent::saved($entry);
    }

    /**
     * Fired after an image is deleted.
     *
     * @param EntryInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        // Retrieve page
        $block = BlockModel::find($entry->block);
        $page = PageModel::find($block->page);

        // Dump the block cache for this page
        $this->dispatch(new PurgeBlockCache($page));

        parent::deleted($entry);
    }
}

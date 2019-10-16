<?php namespace Lwv\NewsModule\Category;

use Lwv\NewsModule\Category\Command\GetCategoryPath;
use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CategoryPresenter
 */
class CategoryPresenter extends EntryPresenter
{

    use DispatchesJobs;

    /**
     * The presented object.
     * This is for IDE support.
     *
     * @var CategoryInterface
     */
    protected $object;

    /**
     * Return the category path.
     *
     * @return string
     */
    public function path()
    {
        return $this->dispatch(new GetCategoryPath($this->object));
    }
}

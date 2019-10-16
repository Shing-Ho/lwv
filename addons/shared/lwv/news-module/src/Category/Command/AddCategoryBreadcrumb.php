<?php namespace Lwv\NewsModule\Category\Command;

use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddCategoryBreadcrumb
 */
class AddCategoryBreadcrumb
{
    use DispatchesJobs;

    /**
     * The category instance.
     *
     * @var CategoryInterface
     */
    protected $category;

    /**
     * Create a new AddCategoryBreadcrumb instance.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Handle the command.
     *
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            $this->category->getName(),
            $this->dispatch(new GetCategoryPath($this->category))
        );
    }
}

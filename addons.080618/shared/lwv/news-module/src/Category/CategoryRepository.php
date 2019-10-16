<?php namespace Lwv\NewsModule\Category;

use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Lwv\NewsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class CategoryRepository
 */
class CategoryRepository extends EntryRepository implements CategoryRepositoryInterface
{

    /**
     * The category model.
     *
     * @var CategoryModel
     */
    protected $model;

    /**
     * Create a new CategoryRepository instance.
     *
     * @param CategoryModel $model
     */
    public function __construct(CategoryModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a category by it's related
     * posts and it's slug.
     *
     * @param $slug
     * @return null|CategoryInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * All categories
     *
     * @return null|CategoryInterface
     */
    public function all()
    {
        return $this->model->orderBy('slug','ASC')->get();
    }
}

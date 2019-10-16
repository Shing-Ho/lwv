<?php namespace Lwv\NewsModule\Post;

use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Lwv\NewsModule\Category\CategoryModel;
use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Lwv\NewsModule\Type\Contract\TypeInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use DB;

/**
 * Class PostRepository
 */
class PostRepository extends EntryRepository implements PostRepositoryInterface
{

    /**
     * The post model.
     *
     * @var PostModel
     */
    protected $model;

    /**
     * Create a new PostRepository instance.
     *
     * @param PostModel $model
     */
    public function __construct(PostModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a post by it's string ID.
     *
     * @param $id
     * @return null|PostInterface
     */
    public function findByStrId($id)
    {
        return $this->model->where('str_id', $id)->first();
    }

    /**
     * Find a post by it's slug.
     *
     * @param $post
     * @return null|PostInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('slug', $slug)->first();
    }

    /**
     * Find man posts by tag.
     *
     * @param      $tag
     * @param null $limit
     * @return EntryCollection
     */
    public function findManyByTag($tag, $limit = null)
    {
        return $this->model
            ->live()
            ->where('tags', 'LIKE', '%"' . $tag . '"%')
            ->paginate($limit);
    }

    /**
     * Find many posts by category.
     *
     * @param CategoryInterface $category
     * @param null              $limit
     * @return EntryCollection
     */
    public function findManyByCategory(CategoryInterface $category, $limit = null)
    {
        return $this->model
            ->live()
            ->where('category_id', $category->getId())
            ->paginate($limit);
    }

    /**
     * Find many posts by type.
     *
     * @param TypeInterface $type
     * @param null          $limit
     * @return PostCollection
     */
    public function findManyByType(TypeInterface $type, $limit = null)
    {
        return $this->model
            ->live()
            ->where('type_id', $type->getId())
            ->paginate($limit);
    }

    /**
     * Find many posts by type and date.
     *
     * @param               $year
     * @param null          $month
     * @param null          $limit
     * @return PostCollection
     */
    public function findManyByDate($year, $month = null, $limit = null)
    {
        $query = $this->model
            ->live()
            ->whereYear('publish_at', '=', $year);

        if ($month) {
            $query->whereMonth('publish_at', '=', $month);
        }

        return $query->paginate($limit);
    }

    /**
     * Get recent posts.
     *
     * @return EntryCollection
     */
    public function getRecent($limit = null)
    {
        return $this->model
            ->exclude()
            ->live()
            ->paginate($limit);
    }

    /**
     * Get featured posts.
     *
     * @return EntryCollection
     */
    public function getFeatured($limit = null)
    {
        return $this->model
            ->live()
            ->featured()
            ->paginate($limit);
    }

    /**
     * Get live posts.
     *
     * @return PostCollection
     */
    public function getLive()
    {
        return $this->model
            ->live()
            ->get();
    }
}
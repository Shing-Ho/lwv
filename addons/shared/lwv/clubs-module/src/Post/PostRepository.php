<?php namespace Lwv\ClubsModule\Post;

use Lwv\ClubsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class PostRepository extends EntryRepository implements PostRepositoryInterface
{

    /**
     * The entry model.
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
     * Find a post by it's slug.
     *
     * @param $post
     * @return null|PostInterface
     */
    public function findBySlug($cid, $slug)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('club_id', $cid)->where('slug', $slug)->first();
    }

    /**
     * Find many posts by date.
     */
    public function findManyByDate($cid, $type, $year, $month = null, $limit = null)
    {
        $query = $this->model
            ->where('club_id', $cid)
            ->where('post_type', $type)
            ->live()
            ->whereYear('publish_at', '=', $year);

        if ($month) {
            $query->whereMonth('publish_at', '=', $month);
        }

        return $query->paginate($limit);
    }

    /**
     * Get recent posts.
     */
    public function getRecent($cid, $type, $limit = null)
    {
        return $this->model
            ->where('club_id', $cid)
            ->where('post_type', $type)
            ->live()
            ->paginate($limit);
    }

    /**
     * Get live posts.
     */
    public function getLive($cid, $type)
    {
        return $this->model
            ->where('club_id', $cid)
            ->where('post_type', $type)
            ->live()
            ->get();
    }
}

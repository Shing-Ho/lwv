<?php namespace Lwv\NewsModule\Http\Controller;

use Lwv\NewsModule\Category\Command\AddCategoryBreadcrumb;
use Lwv\NewsModule\Post\Command\AddPostBreadcrumb;
use Lwv\NewsModule\Post\Command\AddDateBreadcrumb;
use Lwv\NewsModule\Post\Command\AddPostsBreadcrumb;
use Lwv\NewsModule\Post\Command\AddPostsMetaTitle;
use Lwv\NewsModule\Post\Command\MakePostResponse;
use Lwv\NewsModule\Post\Command\MakePreviewResponse;
use Lwv\NewsModule\Post\Command\GetSettings;
use Lwv\NewsModule\Sidebar\Command\BuildSidebar;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class PostsController
 */
class PostsController extends PublicController
{

    /**
     * Display recent posts.
     *
     * @param PostRepositoryInterface $posts
     * @return \Illuminate\View\View
     */
    public function index(PostRepositoryInterface $posts)
    {
        $settings = $this->dispatch(new GetSettings());

        if (isset($settings['sidebar']) && $settings['sidebar']) {
            $sidebar = $this->dispatch(new BuildSidebar());
        }

        if (isset($settings['enable_index']) && !$settings['enable_index']) {
            abort(404);
        }

        $posts = $posts->getRecent((isset($settings['posts_per_page']))? $settings['posts_per_page'] : 3);

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddPostsMetaTitle());

        return view('module::posts/posts', compact('posts','settings','sidebar','content'));
    }

    /**
     * Preview an existing post.
     *
     * @param PostRepositoryInterface $posts
     * @param                         $id
     * @return \Illuminate\View\View
     */
    public function preview(PostRepositoryInterface $posts, $id)
    {
        if (!$post = $posts->findByStrId($id)) {
            abort(404);
        }

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddPostBreadcrumb($post));

        $this->dispatch(new MakePreviewResponse($post));
        return $post->getResponse();
    }

    /**
     * Search for posts.
     *
     * @param PostRepositoryInterface    $posts
     * @return \Illuminate\View\View
     */
    public function search(PostRepositoryInterface $posts, $year, $month = null, $day = null, $slug = null)
    {
        // Post by slug
        if ($slug) {
            if (!$post = $posts->findBySlug($slug)) {
                abort(404);
            }

            $this->dispatch(new AddPostsBreadcrumb());
            $this->dispatch(new AddPostBreadcrumb($post));

            $this->dispatch(new MakePostResponse($post));
            return $post->getResponse();
        }

        // Posts by date
        $settings = $this->dispatch(new GetSettings());

        if (isset($settings['sidebar']) && $settings['sidebar']) {
            $sidebar = $this->dispatch(new BuildSidebar());
        }

        if ($year && $month) {
            $date = Carbon::create($year, $month, 1, 0, 0, 0)->format('F Y');
        } elseif ($year) {
            $date = Carbon::create($year, $month, 1, 0, 0, 0)->format('Y').' ';
        }

        $posts = $posts->findManyByDate($year,$month,(isset($settings['posts_per_page']))? $settings['posts_per_page'] : 3);

        $this->dispatch(new AddPostsBreadcrumb());

        if (isset($date)) {
            $this->dispatch(new AddDateBreadcrumb($date));
        }

        $this->dispatch(new AddPostsMetaTitle());

        return view('module::posts/posts', compact('posts','settings','sidebar'));
    }
}

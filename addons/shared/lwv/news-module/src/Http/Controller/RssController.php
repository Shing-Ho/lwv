<?php namespace Lwv\NewsModule\Http\Controller;

use Lwv\NewsModule\Category\Contract\CategoryRepositoryInterface;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Routing\ResponseFactory;

/**
 * Class RssController
 */
class RssController extends PublicController
{

    /**
     * Return an RSS feed of recent posts.
     *
     * @param PostRepositoryInterface $posts
     * @param ResponseFactory         $response
     * @return \Illuminate\Http\Response|ResponseFactory
     */
    public function recent(PostRepositoryInterface $posts, ResponseFactory $response)
    {
        $response = $response
            ->view('module::posts/rss', ['posts' => $posts->getRecent(15)])
            ->setTtl(3600);

        $response->headers->set('content-type', 'text/xml');

        return $response;
    }

    /**
     * Return an RSS feed of recent posts by category.
     *
     * @param PostRepositoryInterface     $posts
     * @param CategoryRepositoryInterface $categories
     * @param ResponseFactory             $response
     * @param                             $category
     * @return \Illuminate\Http\Response|ResponseFactory
     */
    public function category(
        PostRepositoryInterface $posts,
        CategoryRepositoryInterface $categories,
        ResponseFactory $response,
        $category
    ) {
        if (!$category = $categories->findBySlug($category)) {
            abort(404);
        }

        $response = $response
            ->view('module::posts/rss', ['posts' => $posts->findManyByCategory($category)])
            ->setTtl(3600);

        $response->headers->set('content-type', 'text/xml');

        return $response;
    }

    /**
     * Return an RSS feed of recent posts by tag.
     *
     * @param PostRepositoryInterface     $posts
     * @param ResponseFactory             $response
     * @param                             $category
     * @return \Illuminate\Http\Response|ResponseFactory
     */
    public function tag(PostRepositoryInterface $posts, ResponseFactory $response, $tag)
    {
        $response = $response
            ->view('module::posts/rss', ['posts' => $posts->findManyByTag($tag)])
            ->setTtl(3600);

        $response->headers->set('content-type', 'text/xml');

        return $response;
    }
}

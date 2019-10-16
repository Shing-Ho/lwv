<?php namespace Lwv\NewsModule\Http\Controller;

use Lwv\NewsModule\Post\Command\AddPostsBreadcrumb;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Lwv\NewsModule\Tag\Command\AddTagBreadcrumb;
use Lwv\NewsModule\Tag\Command\AddTagMetaTitle;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Lwv\NewsModule\Post\Command\GetSettings;
use Lwv\NewsModule\Sidebar\Command\BuildSidebar;

/**
 * Class TagsController
 */
class TagsController extends PublicController
{

    /**
     * Return an index of tag posts.
     *
     * @param PostRepositoryInterface $posts
     * @param                         $tag
     * @return \Illuminate\View\View
     */
    public function index(PostRepositoryInterface $posts, $tag)
    {
        $settings = $this->dispatch(new GetSettings());

        if (isset($settings['sidebar']) && $settings['sidebar']) {
            $sidebar = $this->dispatch(new BuildSidebar());
        }

        $posts = $posts->findManyByTag($tag,(isset($settings['posts_per_page']))? $settings['posts_per_page'] : 3);

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddTagBreadcrumb($tag));
        $this->dispatch(new AddTagMetaTitle($tag));

        return view('module::posts/posts', compact('posts', 'tag', 'settings', 'sidebar'));
    }
}

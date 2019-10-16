<?php namespace Lwv\NewsModule\Http\Controller;

use Lwv\NewsModule\Category\Command\AddCategoryBreadcrumb;
use Lwv\NewsModule\Category\Command\AddCategoryMetadata;
use Lwv\NewsModule\Category\Contract\CategoryRepositoryInterface;
use Lwv\NewsModule\Post\Command\AddPostsBreadcrumb;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Lwv\NewsModule\Post\Command\GetSettings;
use Lwv\NewsModule\Sidebar\Command\BuildSidebar;

/**
 * Class CategoriesController
 */
class CategoriesController extends PublicController
{

    /**
     * Return an index of category posts.
     *
     * @param CategoryRepositoryInterface $categories
     * @param PostRepositoryInterface     $posts
     * @param                             $category
     * @return \Illuminate\View\View
     */
    public function index(CategoryRepositoryInterface $categories, PostRepositoryInterface $posts, $category)
    {
        if (!$category = $categories->findBySlug($category)) {
            abort(404);
        }

        $settings = $this->dispatch(new GetSettings());
        $content = [
            'intro' => $category->intro,
            'footer' => $category->footer
            ];

        if (isset($settings['sidebar']) && $settings['sidebar']) {
            $sidebar = $this->dispatch(new BuildSidebar());
        }

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddCategoryBreadcrumb($category));
        $this->dispatch(new AddCategoryMetadata($category));

        $posts = $posts->findManyByCategory($category, (isset($settings['posts_per_page']))? $settings['posts_per_page'] : 3);

        return view('module::posts/posts', compact('category', 'posts', 'settings', 'sidebar', 'content'));
    }
}

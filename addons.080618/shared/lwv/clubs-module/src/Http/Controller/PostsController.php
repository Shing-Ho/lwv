<?php namespace Lwv\ClubsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Lwv\ClubsModule\Website\Contract\WebsiteRepositoryInterface;
use Lwv\ClubsModule\Post\Contract\PostRepositoryInterface;
use Lwv\ClubsModule\Club\Command\AddClubsBreadcrumb;
use Lwv\ClubsModule\Club\Command\AddClubBreadcrumb;
use Lwv\ClubsModule\Post\Command\AddTypeBreadcrumb;
use Lwv\ClubsModule\Post\Command\AddPostBreadcrumb;
use Lwv\ClubsModule\Post\Command\AddDateBreadcrumb;
use Lwv\ClubsModule\Post\Command\BuildSidebar;
use Carbon\Carbon;

/**
 * Class PostsController
 */
class PostsController extends PublicController
{
    /**
     * Display posts index.
     */
    public function index(ClubRepositoryInterface $clubs, WebsiteRepositoryInterface $websites, PostRepositoryInterface $posts, $slug, $type)
    {
        if (!$club = $clubs->findBySlug($slug)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($club->id)) {
            abort(404);
        }

        if (!$website->enabled) {
            abort(404);
        }

        $posts = $posts->getRecent($club->id,$type,6);
        $sidebar = $this->dispatch(new BuildSidebar($club));

        $this->dispatch(new AddClubsBreadcrumb());
        $this->dispatch(new AddClubBreadcrumb($club));
        $this->dispatch(new AddTypeBreadcrumb($posts->first()));

        return view('module::posts/posts', compact('club','website','posts','sidebar'));
    }

    /**
     * Search posts.
     */
    public function search(ClubRepositoryInterface $clubs, WebsiteRepositoryInterface $websites, PostRepositoryInterface $posts, $cslug, $type, $year, $month = null, $day = null, $slug = null)
    {
        if (!$club = $clubs->findBySlug($cslug)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($club->id)) {
            abort(404);
        }

        if (!$website->enabled) {
            abort(404);
        }

        $sidebar = $this->dispatch(new BuildSidebar($club));
        $this->dispatch(new AddClubsBreadcrumb());
        $this->dispatch(new AddClubBreadcrumb($club));

        // Post by slug
        if ($slug) {
            if (!$post = $posts->findBySlug($club->id, $slug)) {
                abort(404);
            }

            $this->dispatch(new AddTypeBreadcrumb($post));
            //$this->dispatch(new AddPostBreadcrumb($post));

            return view('module::posts/posts', compact('club','website','post','sidebar'));
        }

        // Posts by date
        if ($year && $month) {
            $date = Carbon::create($year, $month, 1, 0, 0, 0)->format('F Y');
        } elseif ($year) {
            $date = Carbon::create($year, $month, 1, 0, 0, 0)->format('Y').' ';
        }

        $posts = $posts->findManyByDate($club->id, $type, $year, $month, 6);

        $this->dispatch(new AddTypeBreadcrumb($posts->first()));

        if (isset($date)) {
            $this->dispatch(new AddDateBreadcrumb($date));
        }

        return view('module::posts/posts', compact('club','website','posts','sidebar'));
    }

    /**
     * Preview an existing post.
     */
    public function preview(ClubRepositoryInterface $clubs, WebsiteRepositoryInterface $websites, PostRepositoryInterface $posts, $id)
    {
        if (!$post = $posts->find($id)) {
            abort(404);
        }

        if (!$club = $clubs->find($post->club_id)) {
            abort(404);
        }

        if (!$website = $websites->findByClub($club->id)) {
            abort(404);
        }

        $sidebar = $this->dispatch(new BuildSidebar($club));
        $this->dispatch(new AddClubsBreadcrumb());
        $this->dispatch(new AddClubBreadcrumb($club));
        $this->dispatch(new AddTypeBreadcrumb($post));

        return view('module::posts/posts', compact('club','website','post','sidebar'));
    }
}

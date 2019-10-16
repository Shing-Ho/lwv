<?php namespace Lwv\ClubsModule\Http\Controller\Admin;

use Lwv\ClubsModule\Club\Contract\ClubRepositoryInterface;
use Lwv\ClubsModule\Post\Contract\PostRepositoryInterface;
use Lwv\ClubsModule\Post\Form\PostFormBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Lwv\ClubsModule\Post\Table\PostTableBuilder;
use Lwv\ClubsModule\Post\Command\GetPostPath;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;

class PostsController extends AdminController
{
    /**
     * Display an index of existing entries.
     */
    public function index(ClubRepositoryInterface $clubRepository, PostTableBuilder $table, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        return $table->setClub($club)->render();
    }

    /**
     * Create a new entry.
     *
     * @param PostFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PostFormBuilder $form, ClubRepositoryInterface $clubRepository, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($id)) {
            abort(404);
        }

        return $form->setClub($club)->render();
    }

    /**
     * Edit an existing entry.
     */
    public function edit(PostFormBuilder $form, ClubRepositoryInterface $clubRepository, PostRepositoryInterface $postRepository, Authorizer $authorizer, $cid, $id)
    {
        if (!$authorizer->authorize('lwv.module.clubs::websites.manage')) {
            abort(403);
        }

        $clubs = $clubRepository->myClubs();

        if (!$club = $clubs->find($cid)) {
            abort(404);
        }

        if (!$news = $postRepository->find($id)) {
            abort(404);
        }

        return $form->setClub($club)->render($id);
    }

    /**
     * Redirect to a post's URL.
     */
    public function view(PostRepositoryInterface $postRepository, Redirector $redirect, $id)
    {
        $post = $postRepository->find($id);

        if (!$post->isLive()) {
            return $redirect->to($this->dispatch(new GetPostPath($post)));
        }

        return $redirect->to($post->path());
    }
}

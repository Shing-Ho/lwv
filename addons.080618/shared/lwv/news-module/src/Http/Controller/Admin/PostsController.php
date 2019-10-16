<?php namespace Lwv\NewsModule\Http\Controller\Admin;

use Lwv\NewsModule\Post\Command\GetPostPath;
use Lwv\NewsModule\Post\Contract\PostInterface;
use Lwv\NewsModule\Post\Contract\PostRepositoryInterface;
use Lwv\NewsModule\Post\Form\Command\AddEntryFormFromPost;
use Lwv\NewsModule\Post\Form\Command\AddEntryFormFromRequest;
use Lwv\NewsModule\Post\Form\Command\AddPostFormFromPost;
use Lwv\NewsModule\Post\Form\Command\AddPostFormFromRequest;
use Lwv\NewsModule\Post\Form\PostEntryFormBuilder;
use Lwv\NewsModule\Post\Table\PostTableBuilder;
use Lwv\NewsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Routing\Redirector;

/**
 * Class PostsController
 */
class PostsController extends AdminController
{

    /**
     * Return a tree of existing posts.
     *
     * @param PostTableBuilder $tree
     * @return \Illuminate\Http\Response
     */
    public function index(PostTableBuilder $tree, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::posts.manage')) {
            abort(403);
        }

        return $tree->render();
    }

    /**
     * Return the modal for choosing a post type.
     *
     * @param  TypeRepositoryInterface $types
     * @return \Illuminate\View\View
     */
    public function choose(TypeRepositoryInterface $types)
    {
        return $this->view->make('module::admin/posts/choose', ['types' => $types->all()]);
    }

    /**
     * Return the form for creating a new post.
     *
     * @param PostEntryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PostEntryFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::posts.manage')) {
            abort(403);
        }

        $this->dispatch(new AddEntryFormFromRequest($form));
        $this->dispatch(new AddPostFormFromRequest($form));

        return $form->render();
    }

    /**
     * Return the form for editing an existing post.
     *
     * @param PostRepositoryInterface $posts
     * @param PostEntryFormBuilder    $form
     * @param                         $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PostRepositoryInterface $posts, PostEntryFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.news::posts.manage')) {
            abort(403);
        }

        $post = $posts->find($id);

        $this->dispatch(new AddEntryFormFromPost($form, $post));
        $this->dispatch(new AddPostFormFromPost($form, $post));

        return $form->render($id);
    }

    /**
     * Redirect to a post's URL.
     *
     * @param PostRepositoryInterface $posts
     * @param Redirector              $redirect
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(PostRepositoryInterface $posts, Redirector $redirect, $id)
    {
        /* @var PostInterface $post */
        $post = $posts->find($id);

        if (!$post->isLive()) {
            return $redirect->to($this->dispatch(new GetPostPath($post)));
        }

        return $redirect->to($post->path());
    }

    /**
     * Delete a post and go back.
     *
     * @param PostRepositoryInterface $posts
     * @param Authorizer              $authorizer
     * @param                         $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(PostRepositoryInterface $posts, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.news::posts.manage')) {
            abort(403);
        }

        $posts->delete($posts->find($id));

        return redirect()->back();
    }
}

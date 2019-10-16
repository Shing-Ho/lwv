<?php namespace Lwv\NewsModule\Http\Controller\Admin;

use Lwv\NewsModule\Category\Contract\CategoryInterface;
use Lwv\NewsModule\Category\Contract\CategoryRepositoryInterface;
use Lwv\NewsModule\Category\Form\CategoryFormBuilder;
use Lwv\NewsModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class CategoriesController
 */
class CategoriesController extends AdminController
{

    /**
     * Return an index of existing categories.
     *
     * @param CategoryTableBuilder $table
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryTableBuilder $table, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::categories.manage')) {
            abort(403);
        }

        return $table->render();
    }

    /**
     * Create the form for creating a new category.
     *
     * @param CategoryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CategoryFormBuilder $form, Authorizer $authorizer)
    {
        if (!$authorizer->authorize('lwv.module.news::categories.manage')) {
            abort(403);
        }

        return $form->render();
    }

    /**
     * Return the form for editing an existing category.
     *
     * @param CategoryFormBuilder $form
     * @param                     $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CategoryFormBuilder $form, Authorizer $authorizer, $id)
    {
        if (!$authorizer->authorize('lwv.module.news::categories.manage')) {
            abort(403);
        }

        return $form->render($id);
    }

    /**
     * Redirect to a category's URL.
     *
     * @param CategoryRepositoryInterface $categories
     * @param                             $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(CategoryRepositoryInterface $categories, $id)
    {
        /* @var CategoryInterface $category */
        $category = $categories->find($id);

        return $this->redirect->to($category->path());
    }

    /**
     * Go to assignments.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignments(StreamRepositoryInterface $streams)
    {
        $stream = $streams->findBySlugAndNamespace('categories', 'posts');

        return $this->redirect->to('admin/news/fields/assignments/' . $stream->getId());
    }
}
